<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'shops';

    protected $appends = [
        'platform_label',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'name',
        'platform',
        'api_key',
        'api_secret',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    protected $filterable = [
        'id',
        'name',
        'platform',
        'api_key',
        'api_secret',
        'access_token',
        'refresh_token',
        'expires_at',
    ];

    protected $fillable = [
        'name',
        'platform',
        'api_key',
        'api_secret',
        'first_route_name',
        'second_route_name',
        'access_token',
        'refresh_token',
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PLATFORM_SELECT = [
        [
            'label' => 'Shopify',
            'value' => 'shopify',
        ],
        [
            'label' => 'Nuvem Shop',
            'value' => 'nuvem_shop',
        ],
        [
            'label' => 'Yampi',
            'value' => 'yampi',
        ],
        [
            'label' => 'Mercado Livre',
            'value' => 'mercado_livre',
        ],
    ];

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getPlatformLabelAttribute()
    {
        return collect(static::PLATFORM_SELECT)->firstWhere('value', $this->platform)['label'] ?? '';
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shop_user')
                    ->withTimestamps();
    }
}
