<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'shop_id' => [
                'integer',
                'exists:shops,id',
                'nullable',
            ],
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'required',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'stok' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'sku' => [
                'string',
                'required',
                'unique:products,sku,' . request()->route('product')->id,
            ],
            'external' => [
                'string',
                'required',
                'unique:products,external,' . request()->route('product')->id,
            ],
        ];
    }
}
