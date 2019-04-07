<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Services\BrandService;
use App\Services\WooCommerceService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class BrandController extends Controller
{
    protected $brandService;
    protected $wooService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BrandService $brandService, WoocommerceService $wooService)
    {
        $this->brandService = $brandService;
        $this->wooService = $wooService;
    }


    public function ajaxRequest(Request $request) {
       return app()->make('App\Services\DataTableService')->renderBrandsDataTable($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('admin.brands.index');
    }  

    public function store(Request $request)
    {

        return $this->brandService->create($request->all());
    }  

    public function update($brandId, Request $request)
    {
        return $this->brandService->update($brandId, $request->all());
    } 

    public function edit($brandId)
    {
        $brand = $this->wooService->getBrand($brandId);
        return response()->json($brand[0]);
    }    

     public function destroy($brandId)
    {
        return $this->brandService->delete($brandId);
    }    
}
