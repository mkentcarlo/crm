<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;
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
        return app()->make('App\Services\DataTableService')->renderCustomersDataTable();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->groupService->getGroups();

        return view('admin.customers.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request input post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $customer = new Customer($request->all());
        if ($customer->save()) {
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
    public function edit($customerId)
    {
        $customer = Customer::where('id', $customerId)->first();
        $customer->group = $customer->group;
        
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request input post
     * @param int          $id      an id of specific table being pass
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if ($customer->update($request->all())) {
            $customer->group->update(['id' => $request->group_id]);

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
        $customer      = Customer::find($id);
  
        if ($customer->delete()) {
            
            return response()->json(
                [
                    'success' => true,
                    'title' => 'Deleted',
                    'msg' => 'Customer has been deleted!',
                    'type' => 'success'
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'title' => 'Deleted',
                'msg' => 'Failed to delete customer!',
                'type' => 'error'
            ]
        );
    }
}
