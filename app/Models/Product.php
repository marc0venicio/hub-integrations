<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'products';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'shop.name',
        'name',
        'description',
        'price',
        'stok',
        'sku',
        'external',
    ];

    protected $filterable = [
        'id',
        'shop.name',
        'name',
        'description',
        'price',
        'stok',
        'sku',
        'external',
    ];

    protected $fillable = [
        'shop_id',
        'name',
        'description',
        'price',
        'stok',
        'sku',
        'external',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
