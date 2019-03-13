<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
   
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'admin';
        $roleAdmin->guard_name = 'web';
        $roleAdmin->save();

        $permission = new Permission();
        $permission->name = 'view.user';
        $permission->guard_name = 'web';
        $permission->save();
        
        $permission = new Permission();
        $permission->name = 'create.user';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.user';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.user';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'view.customer';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'create.customer';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.customer';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.customer';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'view.product';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'create.product';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.product';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.product';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'view.brand';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'create.brand';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.brand';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.brand';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'view.category';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'create.category';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.category';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.category';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'view.invoice';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'create.invoice';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.invoice';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.invoice';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'view.report';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'create.report';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit.report';
        $permission->guard_name = 'web';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'delete.report';
        $permission->guard_name = 'web';
        $permission->save();
    }
}
