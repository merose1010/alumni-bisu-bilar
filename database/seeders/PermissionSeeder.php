<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
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
        $roleSuperAdmin = Role::create(['name' => 'Super-Admin']);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleFrontDesk = Role::create(['name' => 'ID Staff']);
        $roleFrontDesk = Role::create(['name' => 'Secretary']);
        $clientUsers = Role::create(['name' => 'Student']);
    
        $permissionView = Permission::create(['name' => 'can:view-record']);
        $permissionEdit = Permission::create(['name' => 'can:edit-record']);
        $permissionDelete = Permission::create(['name' => 'can:delete-record']);
        $permissionAdd = Permission::create(['name' => 'can:add-record']);
        $permissionManage = Permission::create(['name' => 'can:manage-admins']);
    
        // SUPER ADMIN
        $roleSuperAdmin->givePermissionTo($permissionView);
        $roleSuperAdmin->givePermissionTo($permissionEdit);
        $roleSuperAdmin->givePermissionTo($permissionDelete);
        $roleSuperAdmin->givePermissionTo($permissionManage);
        $roleSuperAdmin->givePermissionTo($permissionAdd);
    
        // ADMIN
        $roleAdmin->givePermissionTo($permissionView);
        $roleAdmin->givePermissionTo($permissionEdit);
        $roleAdmin->givePermissionTo($permissionDelete);
        $roleAdmin->givePermissionTo($permissionManage);
        $roleSuperAdmin->givePermissionTo($permissionAdd);

    
        // FRONT DESK
        $roleFrontDesk->givePermissionTo($permissionView);
    }
}
