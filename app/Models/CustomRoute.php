<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomRoute extends Model
{
    use HasAdvancedFilter, SoftDeletes, HasFactory;

    public $table = 'custom_routes';

    protected $orderable = [
        'id',
        'user_name',
        'route',
    ];

    protected $filterable = [
        'id',
        'user_name',
        'route',
    ];

    protected $dates = [

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_route_name',
        'second_route_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
