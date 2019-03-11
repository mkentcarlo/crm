<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionService  
{
	public function getRoles() 
	{
		return Role::all();
	}
}	