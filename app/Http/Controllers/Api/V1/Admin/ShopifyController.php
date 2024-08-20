<?php

namespace App\Http\Controllers\Api\V1\Admin;
use App\Http\Controllers\Controller;
use App\Services\Shopify\ShopifyService;
use Illuminate\Http\Client\Request;


class ShopifyController extends Controller
{
    protected $shopifyService;

    public function __construct()
    {
        $shop = 'your_shop_name.myshopify.com';
        $accessToken = 'your_access_token';

        $this->shopifyService = new ShopifyService($shop, $accessToken);
    }

    public function index()
    {
        $products = $this->shopifyService->getProducts();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $productData = $request->all();
        $product = $this->shopifyService->createProduct($productData);
        return response()->json($product);
    }
}
