<?php

namespace App\Http\Controllers;

use App\Services\RolePermissionService;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    protected $rolePermssionService;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RolePermissionService $rolePermssionService)
    {
        $this->rolePermissionService = $rolePermssionService;
    }
    
    public function ajaxRequest() {
        return app()->make('App\Services\DataTableService')->renderRolesDataTable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index', compact('roles'));
    }
}
