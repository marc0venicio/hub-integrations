<?php
use App\Http\Controllers\Api\V1\Admin\ShopifyAuthController;
use App\Http\Controllers\Api\V1\Admin\ShopifyController;

Route::get('health', function(){
    return 'ok';
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {
    // Abilities
    Route::apiResource('abilities', 'AbilitiesController', ['only' => ['index']]);

    // Locales
    Route::get('locales/languages', 'LocalesController@languages')->name('locales.languages');
    Route::get('locales/messages', 'LocalesController@messages')->name('locales.messages');

    // Permissions
    Route::resource('permissions', 'PermissionsApiController');

    // Roles
    Route::resource('roles', 'RolesApiController');

    // Users
    Route::resource('users', 'UsersApiController');

    // Plan
    Route::resource('plans', 'PlanApiController');

    // Shop
    Route::resource('shops', 'ShopApiController');

    // Product
    Route::resource('products', 'ProductApiController');

    // Order
    Route::resource('orders', 'OrderApiController');

    // Subscription
    Route::resource('subscriptions', 'SubscriptionApiController');


});
Route::prefix('shopify')->group(function () {

        Route::get('/auth', [ShopifyAuthController::class, 'authShopify'])->name('shopify.auth');

        Route::get('/callback', [ShopifyAuthController::class, 'handleCallback'])->name('shopify.callback');

        Route::get('/products', [ShopifyController::class, 'index'])->name('shopify.products');

        Route::post('/products', [ShopifyController::class, 'store'])->name('shopify.products.store');
    });
