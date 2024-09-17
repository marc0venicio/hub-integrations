<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShopifyAuthController extends Controller
{
    public function installShopify(Request $request)
    {
        $path = $request->path();

        $userName = explode('install/', $path)[1];

        $apiKey = Shop::with('users')
            ->where('shops.name', $userName)
            ->where('shops.platform', 'shopify')
            ->first();

        $shop = $request->query('shop');

        $api_key = $apiKey->api_key;

        $scopes = "read_orders,write_products";

        $redirect_uri = secure_url(route('shopify.'.$userName, [], false));

        $install_url = "https://{$shop}/admin/oauth/authorize";
        $install_url .= "?client_id={$api_key}";
        $install_url .= "&scope={$scopes}";
        $install_url .= "&redirect_uri=" . urlencode($redirect_uri);

        Log::info($install_url);

        return redirect()->away($install_url);
    }

    public function generateToken(Request $request)
    {
        Log::info($request->all());

        $path = $request->path();
        $userName = explode('generate_token/', $path)[1];

        $shop = Shop::with('users')
            ->where('shops.name', $userName)
            ->where('shops.platform', 'shopify')
            ->first();

        if (!$shop) {
            return response()->json(['error' => 'Shop not found'], 404);
        }

        $api_key = $shop->api_key;
        $shared_secret = $shop->api_secret;

        $params = $request->all();
        $hmac = $request->query('hmac');

        unset($params['hmac']);
        ksort($params);

        $computed_hmac = hash_hmac('sha256', http_build_query($params), $shared_secret);

        if (hash_equals($hmac, $computed_hmac)) {
            $query = [
                "client_id" => $api_key,
                "client_secret" => $shared_secret,
                "code" => $params['code']
            ];

            $access_token_url = "https://{$params['shop']}/admin/oauth/access_token";

            $response = Http::post($access_token_url, $query);

            if ($response->successful()) {
                $result = $response->json();
                $access_token = $result['access_token'];

                $shop->update([
                    'access_token' => $access_token,
                    'refresh_token' => $result['refresh_token'] ?? null,
                    'expires_at' => $result['expires_at'] ?? null,
                ]);

                Log::info("Access token saved for shop: {$shop->name}");
                return response()->json(['access_token' => $access_token]);
            } else {
                Log::error('Failed to retrieve access token', ['response' => $response->body()]);
                return response()->json(['error' => 'Failed to retrieve access token'], 500);
            }
        } else {
            return response()->json(['error' => 'This request is NOT from Shopify!'], 403);
        }
    }

}
