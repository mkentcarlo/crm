<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin    = Role::where('name', 'admin')->first();
    
        $admin           = new User();
        $admin->name     = 'admin';
        $admin->username     = 'admin';
        $admin->firstname     = 'admin';
        $admin->lastname     = 'admin';
        $admin->position     = 'admin';
        $admin->email    = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->assignRole($role_admin->id);
    }
}
