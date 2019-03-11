<?php

namespace App\Services;

use  App\CustomerGroup;

class GroupService  
{
	public function getGroups() 
	{
		return CustomerGroup::all();
	}
}	