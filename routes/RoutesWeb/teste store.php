<?php

use App\Http\Controllers\Api\V1\Admin\ShopifyAuthController;

Route::prefix('shopify')->group(function () {
    Route::get('werwer', [ShopifyAuthController::class, 'installShopify'])->name('shopify.werwer');
    Route::get('werwersasd/', [ShopifyAuthController::class, 'generateToken'])->name('shopify.werwersasd');
});
