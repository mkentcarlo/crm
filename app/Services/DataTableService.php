<?php

namespace App\Services;

use DataTables;
use Illuminate\Http\Request;

class DataTableService  {

	public function renderProductsDataTable() 
    {
		$products = app()->make('App\Services\ProductService')->getProducts();

		return DataTables::of($products)
		->addColumn('categories', function($product) {
            return $product['categories'];
        })
        ->addColumn('brands', function($product) {
            return $product['brands'];
       })
        ->addColumn('action', function($product) {

        return '<a href="'.url('products/edit/'.$product['id']).'" class="text-inverse pr-10 form-load" title="Edit"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('products/delete/'.$product['id']).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
		->rawColumns(['categories','brands','action'])
        ->make(true);
	}

    public function renderCategoriesDataTable() 
    {
        $categories = app()->make('App\Services\CategoryService')->getCategories();

        return DataTables::of($categories)
        ->addColumn('action', function($category) {

        return '<a href="#" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$category['id'].'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('categories/delete/'.$category['id']).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function renderBrandsDataTable() 
    {
        $brands = app()->make('App\Services\BrandService')->getBrands();

        return DataTables::of($brands)
        ->addColumn('action', function($brand) {

        return '<a href="#" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$brand['id'].'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('brands/delete/'.$brand['id']).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function renderGroupsDataTable() 
    {
        $groups = app()->make('App\Services\GroupService')->getGroups();

        return DataTables::of($groups)
         ->addColumn('created_at', function($group) {
            return date('M d Y h:i a', strtotime($group->created_at));
        })
        ->addColumn('action', function($group) {
            return '<a href="#" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$group->id.'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('groups/delete/'.$group->id).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function renderRolesDataTable() 
    {
        $roles = app()->make('App\Services\RolePermissionService')->getRoles();

        return DataTables::of($roles)
          ->addColumn('name', function($role) {
            return ($role->name == 'admin') ? 'Administrator' : $role->name;
         })    
         ->addColumn('permissions', function($role) {
            $content = "";
            $permissions = $role->permissions()->get();
            
            $manage = ['users','customers', 'products', 'brands', 'categories', 'invoices', 'reports'];
            $allPermission = [];

            foreach ($permissions as $permission) {
                $name = explode('.', $permission->name);
                $key = end($name) .'s';
                if (in_array($key, $manage)) {
                    $allPermission[$key][] = $name[0];
                }
            }

            foreach($allPermission as $key => $value)
            {
                if ($value) {
                    $permission = $key;
                }
                $permission = $key.' | '.implode(' | ', $value);
                $content .= '<span class="label label-gold">'.ucwords($permission).'</span> ';
            }

            return $content;
        })
         ->addColumn('created_at', function($role) {
            return date('M d Y h:i a', strtotime($role->created_at));
        })
        ->addColumn('action', function($role) {
            return '<a href="#" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$role->id.'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('roles/delete/'.$role->id).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['permissions', 'action'])
        ->make(true);
    }

    public function renderCustomersDataTable() 
    {
        $customers = app()->make('App\Services\CustomerService')->getCustomers();

        return DataTables::of($customers)
        ->addColumn('name', function($customer) {
            return $customer->lastname .' '. $customer->firstname;
        })
        ->addColumn('group_name', function($customer) {
            return $customer->group->name;
        })
        ->addColumn('created_at', function($customer) {
            return date('M d Y h:i a', strtotime($customer->created_at));
        })
        ->addColumn('action', function($customer) {
            return '<a href="#" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$customer->id.'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('customers/delete/'.$customer->id).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['name','group_name','action'])
        ->make(true);
    }

    public function renderInvoicesDataTable(Request $request) 
    {
        $invoices = app()->make('App\Services\InvoiceService')->getInvoices($request);
 
        return DataTables::of($invoices)
         ->addColumn('status', function($invoice) {
            if($invoice->status == 1) {
                return '<span class="label label-warning">pending</span>';
            } else if($invoice->status == 2) {
                return '<span class="label label-danger">unpaid</span>';
            } else if($invoice->status == 3) { 
                return '<span class="label label-success">paid</span>';
            };    
        })
         ->addColumn('total_amount', function($invoice) {
            return ($invoice->total_amount) ? '$'.number_format($invoice->total_amount, 2) : '0.00';
        })
         ->addColumn('created_at', function($invoice) {
            return date('Y/m/d', strtotime($invoice->created_at));
        })
          ->addColumn('due_date', function($invoice) {
            return date('Y/m/d', strtotime($invoice->due_date));
        })
        ->addColumn('action', function($invoice) {
            return '<a href="'.route('edit.invoice', $invoice->id).'" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$invoice->id.'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('invoices/delete/'.$invoice->id).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['status', 'total_amount', 'created_at', 'due_date', 'action'])
        ->make(true);
    }

    public function renderReportsDataTable(Request $request) 
    {
        $invoices = app()->make('App\Services\InvoiceService')->getReports($request);
 
        return DataTables::of($invoices)
         ->addColumn('status', function($invoice) {
            if($invoice->status == 1) {
                return '<span class="label label-warning">pending</span>';
            } else if($invoice->status == 2) {
                return '<span class="label label-danger">unpaid</span>';
            } else if($invoice->status == 3) { 
                return '<span class="label label-success">paid</span>';
            };    
        })
         ->addColumn('total_amount', function($invoice) {
            return ($invoice->total_amount) ? '$'.number_format($invoice->total_amount, 2) : '0.00';
        })
         ->addColumn('created_at', function($invoice) {
            return date('Y/m/d', strtotime($invoice->created_at));
        })
          ->addColumn('due_date', function($invoice) {
            return date('Y/m/d', strtotime($invoice->due_date));
        })
        ->addColumn('action', function($invoice) {
            return '<a href="'.route('view.pdf', $invoice->id).'" class="text-inverse pr-10 form-load view" title="View" id="'.$invoice->id.'"><i class="fa fa-file-text-o txt-default"></i></a>';
        })
        ->rawColumns(['status', 'total_amount', 'created_at', 'due_date', 'action'])
        ->make(true);
    }

    public function renderTransactionsDataTable() 
    {
        $invoices = app()->make('App\Services\InvoiceService')->getTransactions();
 
        return DataTables::of($invoices)
         ->addColumn('status', function($invoice) {
            if($invoice->status == 1) {
                return '<span class="label label-warning">pending</span>';
            } else if($invoice->status == 2) {
                return '<span class="label label-danger">unpaid</span>';
            } else if($invoice->status == 3) { 
                return '<span class="label label-success">paid</span>';
            };    
        })
         ->addColumn('total_amount', function($invoice) {
            return ($invoice->total_amount) ? '$'.number_format($invoice->total_amount, 2) : '0.00';
        })
         ->addColumn('created_at', function($invoice) {
            return date('Y/m/d', strtotime($invoice->created_at));
        })
          ->addColumn('due_date', function($invoice) {
            return date('Y/m/d', strtotime($invoice->due_date));
        })
        ->addColumn('action', function($invoice) {
            return '<a href="#" class="text-inverse pr-10 form-load view" title="View" id="'.$invoice->id.'"><i class="fa fa-file-text-o txt-default"></i></a>';
        })
        ->rawColumns(['status', 'total_amount', 'created_at', 'due_date', 'action'])
        ->make(true);
    }
}	