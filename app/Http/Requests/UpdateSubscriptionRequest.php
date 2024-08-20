<?php

namespace App\Http\Requests;

use App\Models\Subscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('subscription_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'plan_id' => [
                'integer',
                'exists:plans,id',
                'nullable',
            ],
            'status' => [
                'required',
                'in:' . implode(',', Arr::pluck(Subscription::STATUS_SELECT, 'value')),
            ],
            'started_at' => [
                'date_format:' . config('project.datetime_format'),
                'required',
            ],
            'expires_at' => [
                'date_format:' . config('project.datetime_format'),
                'nullable',
            ],
        ];
    }
}
