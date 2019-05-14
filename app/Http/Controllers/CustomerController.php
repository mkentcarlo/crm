<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\Customer;
use Illuminate\Http\Request;
use FaimMedia;
use App\CustomerGroup;

class CustomerController extends Controller
{
    protected $customerService;
    protected $groupService;
    protected $mailchimp;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GroupService $groupService)
    {
        $apiKey = env('MAILCHIMP_API_KEY');
        $this->groupService = $groupService;
        $this->mailchimp = new FaimMedia\MailChimp($apiKey);
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
        $customers = Customer::all();
        
        return view('admin.customers.index', compact('groups', 'customers'));
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
        $groupId = CustomerGroup::find($request->group_id)->first()->list_id;
        $list = $this->mailchimp->lists()->getById($groupId);
        $street = $request->street_address ?? null;
        $city = $request->city ?? null;
        $state = $request->state ?? null;
        $country = $request->country?? null;
        $code = $request->postal_code ?? null;
        $address = $street .' '. $city  .' '. $state .' '. $country .', '.$code;
        $member = $list->members()->add([
            'email_address' => $request->email,
            'merge_fields'  => [
                'FNAME' => $request->firstname,
                'LNAME' => $request->lastname,
                'PHONE' => $request->contact,
                'ADDRESS' => $address
            ],
        ]);
        if ($member) {
            $customer = new Customer($request->all());
            if ($customer->save()) {
                return response()->json(
                    [
                        'success' => true,
                        'msg' => 'Success'
                    ]
                );
            }
        } else {
            return response()->json(
                [
                    'success' => false,
                    'msg' => 'Failed'
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

    public function show($customerId)
    {
        $customer = Customer::where('id', $customerId)->first();
        $customer->group = $customer->group;

        return response()->json($customer);
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
        $groupId = CustomerGroup::find($request->group_id)->first()->list_id;
        $list = $this->mailchimp->lists()->getById($groupId);
        $member = $list->members()->getByEmail($customer->email);
        $street = $request->street_address ?? null;
        $city = $request->city ?? null;
        $state = $request->state ?? null;
        $country = $request->country?? null;
        $code = $request->postal_code ?? null;
        $address = $street .' '. $city  .' '. $state .' '. $country .', '.$code;
        if ($member) {
            $member->set([
                'email_address' => $request->email,
                'merge_fields'  => [
                    'FNAME' => $request->firstname,
                    'LNAME' => $request->lastname,
                    'PHONE' => $request->contact,
                    'ADDRESS' => $address
                ],
            ]);
            $member->save();
        } else {
            $groupId = CustomerGroup::find($customer->group_id)->first()->list_id;
            $list = $this->mailchimp->lists()->getById($groupId);
            $member = $list->members()->getByEmail($customer->email);
            $member->delete();
            $list->members()->add([
                'email_address' => $request->email,
                'merge_fields'  => [
                    'FNAME' => $request->firstname,
                    'LNAME' => $request->lastname,
                    'PHONE' => $request->contact,
                    'ADDRESS' => $address
                ],
            ]);
        }
        
        if ($customer->update($request->all())) {
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
        $groupId = CustomerGroup::find($customer->group_id)->first()->list_id;
        $list = $this->mailchimp->lists()->getById($groupId);
        $member = $list->members()->getByEmail($customer->email);
        $member->delete();

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

    public function getTransactions($id) 
    {
        return app()->make('App\Services\DataTableService')->renderTransactionsDataTableByCustomerId($id);
    }
}
