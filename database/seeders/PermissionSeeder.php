<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make admin pages permissions
        $admin_parents = [
            'admins' => ['view', 'add', 'edit', 'delete'],
            'users' => ['view', 'add', 'edit', 'delete'],
            'products' => ['view', 'add', 'edit', 'delete'],
            'categories' => ['view', 'add', 'edit', 'delete'],
            'orders' => ['view', 'add', 'edit', 'delete'],
            // 'coupons' => ['view', 'add', 'edit', 'delete'],
            'attributes' => ['view', 'add', 'edit', 'delete'],
            'attribute_values' => ['view', 'add', 'edit', 'delete'],
            // 'offers' => ['view', 'add', 'edit', 'delete'],
            'static_pages' => ['view', 'add', 'edit', 'delete'],
            'reviews' => ['view', 'add', 'edit', 'delete'],
            // 'shipping_companies' => ['view', 'add', 'edit', 'delete'],
            'home_sections' => ['view', 'add', 'edit', 'delete'],
            'roles' => ['view', 'add', 'edit', 'delete'],
            'home' => ['view'],
            'settings' => ['view', 'add', 'edit', 'delete'],
            'adds' => ['view', 'add', 'edit', 'delete'],
        ];
        foreach ($admin_parents as $parent => $types) {
            foreach ($types as $type) {
                Permission::create(['name_key' => $type, 'guard_name'=>'admin', 'name' => "$type" . "_" . $parent, 'parent' => $parent]);
            }
        }
    }
}
