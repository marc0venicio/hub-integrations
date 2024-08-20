<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'plan_create',
            ],
            [
                'id'    => 18,
                'title' => 'plan_edit',
            ],
            [
                'id'    => 19,
                'title' => 'plan_show',
            ],
            [
                'id'    => 20,
                'title' => 'plan_delete',
            ],
            [
                'id'    => 21,
                'title' => 'plan_access',
            ],
            [
                'id'    => 22,
                'title' => 'shop_create',
            ],
            [
                'id'    => 23,
                'title' => 'shop_edit',
            ],
            [
                'id'    => 24,
                'title' => 'shop_show',
            ],
            [
                'id'    => 25,
                'title' => 'shop_delete',
            ],
            [
                'id'    => 26,
                'title' => 'shop_access',
            ],
            [
                'id'    => 27,
                'title' => 'product_create',
            ],
            [
                'id'    => 28,
                'title' => 'product_edit',
            ],
            [
                'id'    => 29,
                'title' => 'product_show',
            ],
            [
                'id'    => 30,
                'title' => 'product_delete',
            ],
            [
                'id'    => 31,
                'title' => 'product_access',
            ],
            [
                'id'    => 32,
                'title' => 'order_create',
            ],
            [
                'id'    => 33,
                'title' => 'order_edit',
            ],
            [
                'id'    => 34,
                'title' => 'order_show',
            ],
            [
                'id'    => 35,
                'title' => 'order_delete',
            ],
            [
                'id'    => 36,
                'title' => 'order_access',
            ],
            [
                'id'    => 37,
                'title' => 'subscription_create',
            ],
            [
                'id'    => 38,
                'title' => 'subscription_edit',
            ],
            [
                'id'    => 39,
                'title' => 'subscription_show',
            ],
            [
                'id'    => 40,
                'title' => 'subscription_delete',
            ],
            [
                'id'    => 41,
                'title' => 'subscription_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
