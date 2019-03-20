<?php

namespace App\Http\Controllers;

use App\Services\RolePermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        return view('admin.roles.index');
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        if ($role) {
            if ($request->permission) {
                foreach($request->permission as $permission)
                {
                    $role->givePermissionTo($permission);
                }
            }

            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Success'
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'msg' => 'Failed'
            ]
        );
    }

    public function edit($roleId)
    {
        $role = Role::findOrFail($roleId);
        $data['info'] = $role;
        $permissions = $role->permissions()->get();
        $data['permissions'] = [];
        foreach ($permissions as $key => $value) {
            $data['permissions'][] = $value->name;
        }

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        
        if ($role->update(['name' => $request->name])) {
            $permissions = $role->permissions()->get();

            foreach ($permissions as $key => $value) {
                if(!in_array($value->name, $request->permission)) {
                    $role->revokePermissionTo($value->name);
                }
            }  

            if ($request->permission) {
                foreach($request->permission as $name)
                {
                    $role->givePermissionTo($name);
                }
            }
           
            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Success.'
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'msg' => 'Failed.'
            ]
        );
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        if ($role->delete()) {   
            return response()->json(
                [
                    'success' => true,
                    'title' => 'Deleted',
                    'msg' => 'Role has been deleted!',
                    'type' => 'success'
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'title' => 'Deleted',
                'msg' => 'Failed to delete role!',
                'type' => 'error'
            ]
        );
    }
}
