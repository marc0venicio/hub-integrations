<?php

namespace App\Services\Shopify;

use GuzzleHttp\Client;
use Shopify\Clients\Rest;
class ShopifyService
{
    protected $client;
    protected $shop;
    protected $accessToken;

    public function __construct($shop, $accessToken)
    {
        $this->shop = $shop;
        $this->accessToken = $accessToken;
        $this->client = new Rest($shop, $accessToken);
    }

    public static function getAccessToken($shop, $code)
    {
        $client = new Client();

        $response = $client->post("https://$shop/admin/oauth/access_token", [
            'form_params' => [
                'client_id' => env('SHOPIFY_API_KEY'),
                'client_secret' => env('SHOPIFY_API_SECRET'),
                'code' => $code,
            ],
        ]);

        dd($response);

        return json_decode($response->getBody(), true)['access_token'];
    }

    public function getProducts()
    {
        $response = $this->client->get('products');
        return $response->getDecodedBody();
    }

    public function createProduct(array $productData)
    {
        $response = $this->client->post('products', $productData);
        return $response->getDecodedBody();
    }
}
