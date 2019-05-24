<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\Customer;
use Illuminate\Http\Request;
use FaimMedia;
use App\CustomerGroup;
use App\Http\Requests\CustomerFormRequest;

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
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        return view('admin.customers.index', compact('groups', 'customers', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request input post
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerFormRequest $request)
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
    public function update(CustomerFormRequest $request, $id)
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
