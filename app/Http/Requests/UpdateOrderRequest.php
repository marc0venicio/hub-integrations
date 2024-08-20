<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
    }

    public function rules()
    {
        return [
            'shop_id' => [
                'integer',
                'exists:shops,id',
                'nullable',
            ],
            'order_number' => [
                'string',
                'required',
                'unique:orders,order_number,' . request()->route('order')->id,
            ],
            'status' => [
                'required',
                'in:' . implode(',', Arr::pluck(Order::STATUS_SELECT, 'value')),
            ],
            'total_amount' => [
                'numeric',
                'required',
            ],
            'external' => [
                'string',
                'required',
                'unique:orders,external,' . request()->route('order')->id,
            ],
        ];
    }
}
