<?php

namespace App\Providers;

use App\Services\Shopify\ShopifyService;
use Illuminate\Support\ServiceProvider;

class ShopifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ShopifyService::class, function ($app) {
            $shop = 'your_shop_name.myshopify.com';
            $accessToken = 'your_access_token';

            return new ShopifyService($shop, $accessToken);
        });
    }

}
