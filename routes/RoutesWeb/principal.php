<?php

use App\Http\Controllers\Api\V1\Admin\ShopifyAuthController;

Route::redirect('/', '/login');
Route::redirect('/dashboard', '/admin/dashboard');

Auth::routes(['register' => false]);

Route::group([
    'prefix'     => 'admin',
    'as'         => 'admin.',
    'namespace'  => 'Admin',
    'middleware' => ['auth'],
], function () {
    Route::view('/{any?}', 'layouts.admin.app')->name('dashboard')->where('any', '.*');
});

Route::prefix('shopify')->group(function () {
    Route::get('/install', [ShopifyAuthController::class, 'installShopify'])->name('shopify.install');
    Route::get('/generate_token', [ShopifyAuthController::class, 'generateToken'])->name('shopify.generate_token');
});
