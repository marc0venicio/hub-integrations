<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class StoreShopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'platform' => [
                'required',
                'in:' . implode(',', Arr::pluck(Shop::PLATFORM_SELECT, 'value')),
            ],
            'api_key' => [
                'string',
                'nullable',
            ],
            'api_secret' => [
                'string',
                'nullable',
            ],
            'access_token' => [
                'string',
                'nullable',
            ],
            'refresh_token' => [
                'string',
                'nullable',
            ],
            'expires_at' => [
                'string',
                'nullable',
            ],
        ];
    }
}
