<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\CustomerGroup;
use Illuminate\Http\Request;
use App\Http\Requests\GroupFormRequest;

class CustomerGroupController extends Controller
{
    protected $groupService;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }
    
    public function ajaxRequest() {
        return app()->make('App\Services\DataTableService')->renderGroupsDataTable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->groupService->getGroups();
        
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request input post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GroupFormRequest $request)
    {
        $group = new CustomerGroup($request->all());
        if ($group->save()) {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param MShop $shop information of specific shop
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($groupId)
    {
        $group = CustomerGroup::where('id', $groupId)->first();

        return response()->json($group);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request input post
     * @param int          $id      an id of specific table being pass
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GroupFormRequest $request, $id)
    {
        $group = CustomerGroup::find($id);

        if ($group->update($request->all())) {
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
 
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id an id of specific table being pass
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group      = CustomerGroup::find($id);
  
        if ($group->delete()) {
            
            return response()->json(
                [
                    'success' => true,
                    'title' => 'Deleted',
                    'msg' => 'Group has been deleted!',
                    'type' => 'success'
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'title' => 'Deleted',
                'msg' => 'Failed to delete group!',
                'type' => 'error'
            ]
        );
    }

    public function getGroups()
    {
        return $this->groupService->getGroups();
    }
}
