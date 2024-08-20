<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'orders';

    protected $appends = [
        'status_label',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'shop.name',
        'order_number',
        'status',
        'total_amount',
        'external',
    ];

    protected $filterable = [
        'id',
        'shop.name',
        'order_number',
        'status',
        'total_amount',
        'external',
    ];

    protected $fillable = [
        'shop_id',
        'order_number',
        'status',
        'total_amount',
        'external',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        [
            'label' => 'Pending',
            'value' => 'pending',
        ],
        [
            'label' => 'Processing',
            'value' => 'processing',
        ],
        [
            'label' => 'Shipped',
            'value' => 'shipped',
        ],
        [
            'label' => 'Delivered',
            'value' => 'delivered',
        ],
        [
            'label' => 'Cancelled',
            'value' => 'cancelled',
        ],
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function getStatusLabelAttribute()
    {
        return collect(static::STATUS_SELECT)->firstWhere('value', $this->status)['label'] ?? '';
    }
}
