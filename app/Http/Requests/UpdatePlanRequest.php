<?php

namespace App\Http\Requests;

use App\Models\Plan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdatePlanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('plan_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'min:3',
                'max:50',
                'required',
                'unique:plans,name,' . request()->route('plan')->id,
            ],
            'description' => [
                'string',
                'required',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'billing_cycle' => [
                'required',
                'in:' . implode(',', Arr::pluck(Plan::BILLING_CYCLE_SELECT, 'value')),
            ],
            'feature' => [
                'string',
                'required',
            ],
            'trial_period_days' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'active' => [
                'required',
                'in:' . implode(',', Arr::pluck(Plan::ACTIVE_RADIO, 'value')),
            ],
        ];
    }
}
