<?php

namespace App\Services;

use DataTables;

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
         ->addColumn('created_at', function($role) {
            return date('M d Y h:i a', strtotime($role->created_at));
        })
        ->addColumn('action', function($role) {
            return '<a href="#" class="text-inverse pr-10 form-load edit" title="Edit" id="'.$role->id.'"><i class="zmdi zmdi-edit txt-warning"></i></a><a href="'.url('roles/delete/'.$role->id).'" class="text-inverse delete" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}	