<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Services\Shopify\ShopifyService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ShopifyAuthController extends Controller
{
    public function authShopify()
    {
        $shop = 'hub-integration.myshopify.com';
        $scopes = env('SHOPIFY_API_SCOPES');
        $redirectUri = route('shopify.callback');
        $apiKey = env('SHOPIFY_API_KEY');

        $client = new Client();

        $response = $client->get("https://$shop/admin/oauth/authorize?client_id=$apiKey&scope=$scopes&redirect_uri=$redirectUri");

        dd(json_decode($response->getBody(), true));
    }

    public function handleCallback(Request $request)
    {
        $shop = $request->input('shop');
        $code = $request->input('code');

        $accessToken = ShopifyService::getAccessToken($shop, $code);

        dd($accessToken);
        // dd($accessToken);
        // Store::where('shop_domain', $shop)->update(['access_token' => $accessToken]);

        return redirect()->route('api.shopify.dashboard')->with('access_token', $accessToken);
    }
}
