<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Resources\Admin\ShopResource;
use App\Models\Shop;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShopResource(Shop::advancedFilter());
    }

    public function store(StoreShopRequest $request)
    {
        $shop = Shop::create($request->validated());

        return (new ShopResource($shop))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create()
    {
        abort_if(Gate::denies('shop_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'platform' => Shop::PLATFORM_SELECT,
            ],
        ]);
    }

    public function show(Shop $shop)
    {
        abort_if(Gate::denies('shop_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShopResource($shop);
    }

    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $shop->update($request->validated());

        return (new ShopResource($shop))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(Shop $shop)
    {
        abort_if(Gate::denies('shop_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new ShopResource($shop),
            'meta' => [
                'platform' => Shop::PLATFORM_SELECT,
            ],
        ]);
    }

    public function destroy(Shop $shop)
    {
        abort_if(Gate::denies('shop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
