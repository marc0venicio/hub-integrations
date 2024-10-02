<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'plans';

    public const ACTIVE_RADIO = [
        [
            'label' => 'Yes',
            'value' => true,
        ],
        [
            'label' => 'No',
            'value' => false,
        ],
    ];

    protected $appends = [
        'billing_cycle_label',
        'active_label',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'name',
        'description',
        'price',
        'billing_cycle',
        'feature',
        'trial_period_days',
        'active',
    ];

    protected $filterable = [
        'id',
        'name',
        'description',
        'price',
        'billing_cycle',
        'feature',
        'trial_period_days',
        'active',
    ];

    protected $fillable = [
        'name',
        'description',
        'price',
        'billing_cycle',
        'feature',
        'trial_period_days',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const BILLING_CYCLE_SELECT = [
        [
            'label' => 'Years',
            'value' => 'years',
        ],
        [
            'label' => 'Monthly',
            'value' => 'monthly',
        ],
        [
            'label' => 'Daily',
            'value' => 'daily',
        ],
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getBillingCycleLabelAttribute()
    {
        return collect(static::BILLING_CYCLE_SELECT)->firstWhere('value', $this->billing_cycle)['label'] ?? '';
    }

    public function getActiveLabelAttribute()
    {
        return collect(static::ACTIVE_RADIO)->firstWhere('value', $this->active)['label'] ?? '';
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

}
