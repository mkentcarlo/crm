<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Services\CategoryService;
use App\Services\WooCommerceService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $wooService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService, WoocommerceService $wooService)
    {
        $this->categoryService = $categoryService;
        $this->wooService = $wooService;
    }


    public function ajaxRequest(Request $request) {
       return app()->make('App\Services\DataTableService')->renderCategoriesDataTable($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.categories.index');
    }  

    public function store(Request $request)
    {

        return $this->categoryService->create($request->all());
    }  

    public function update($categoryId, Request $request)
    {
        return $this->categoryService->update($categoryId, $request->all());
    } 

    public function edit($categoryId)
    {
        $category = $this->wooService->process()->get('products/categories/'. $categoryId)->product_category;
        return response()->json($category);
    }    

     public function destroy($categoryId)
    {
        return $this->categoryService->delete($categoryId);
    }    
}
