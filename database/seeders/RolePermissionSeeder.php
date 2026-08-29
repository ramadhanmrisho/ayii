<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'products.view', 'products.create', 'products.update', 'products.delete',
            'categories.manage', 'brands.manage',
            'media.view', 'media.upload', 'media.delete',
            'homepage.manage', 'about.manage', 'solutions.manage', 'projects.manage',
            'testimonials.manage', 'statistics.manage', 'news.manage',
            'rfqs.view', 'rfqs.update', 'rfqs.assign',
            'enquiries.view', 'enquiries.update',
            'users.manage', 'roles.manage',
            'settings.manage', 'activity_logs.view',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $super = Role::updateOrCreate(['name' => 'Super Administrator', 'guard_name' => 'web']);
        $super->syncPermissions($permissions);

        Role::updateOrCreate(['name' => 'Administrator', 'guard_name' => 'web'])->syncPermissions(array_diff($permissions, ['roles.manage']));
        Role::updateOrCreate(['name' => 'Sales Officer', 'guard_name' => 'web'])->syncPermissions([
            'dashboard.view', 'products.view', 'rfqs.view', 'rfqs.update', 'enquiries.view', 'enquiries.update',
        ]);
        Role::updateOrCreate(['name' => 'Content Manager', 'guard_name' => 'web'])->syncPermissions([
            'dashboard.view', 'products.view', 'products.create', 'products.update',
            'categories.manage', 'brands.manage', 'media.view', 'media.upload',
            'homepage.manage', 'about.manage', 'solutions.manage', 'projects.manage',
            'testimonials.manage', 'statistics.manage', 'news.manage',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
