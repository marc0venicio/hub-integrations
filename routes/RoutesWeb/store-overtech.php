<?php

use App\Http\Controllers\Api\V1\Admin\ShopifyAuthController;

Route::prefix('shopify')->group(function () {
    Route::get('install/store-tech', [ShopifyAuthController::class, 'installShopify'])->name('shopify.store-tech');
    Route::get('generate_token/store-tech', [ShopifyAuthController::class, 'generateToken'])->name('shopify.store-tech');
});
