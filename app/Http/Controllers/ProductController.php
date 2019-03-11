<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Services\ProductService;
use App\Services\WooCommerceService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class ProductController extends Controller
{
    protected $productService;
    protected $wooService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductService $productService, WoocommerceService $wooService)
    {
        $this->productService = $productService;
        $this->wooService = $wooService;
    }


    public function ajaxRequest(Request $request) {
        return app()->make('App\Services\DataTableService')->renderProductsDataTable($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $permission = Permission::create(['name' => 'edit.brand']);

        $categories = $this->wooService->getCategories();
        $brands = $this->wooService->getBrands();

        return view('admin.products.index', compact('categories', 'brands'));
        
        // $permission = Permission::find(2);
        // $permission->update(['name' => 'view.product']);
        // $user = Auth::user();

        // $user->revokePermissionTo('edit.product');
        
        //print_r($user->can('edit products'));
        //$user->assignRole(1);
        //$role = Role::create(['name' => 'admin']);
        //$role = Role::find(1);
        //$role->givePermissionTo();
    }      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->wooService->getCategories();
        $brands = $this->wooService->getBrands();
        
        return view('admin.products.create', compact('categories', 'brands'));
    } 

    public function store(Request $request)
    {
        $coverImage = '';
        if ($request->hasFile('cover_image')) {
            // upload image
            $coverImage = app()->make('App\Services\CustomService')->getUploadedImg($request->file('cover_image'));
        }
        $formData = $request->all();
        $formData['cover_image'] = $coverImage;

        return $this->productService->create($formData);
    }   

    public function edit($productId)
    {
        $categories = $this->wooService->getCategories();
        $brands = $this->wooService->getBrands();
        $product = $this->wooService->process()->get('products/'. $productId)->product;
        $product->categories = $this->wooService->getProductCategories($productId);
        $product->brands = $this->wooService->getProductBrands($productId);

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    } 

    public function update($productId, ProductFormRequest $request)
    {
        $coverImage = '';
        if ($request->hasFile('cover_image')) {
            // upload image
            $coverImage = app()->make('App\Services\CustomService')->getUploadedImg($request->file('cover_image'));
        }
        $formData = $request->all();
        $formData['cover_image'] = $coverImage;
        
        return $this->productService->update($productId, $formData);
    } 

    public function show($productId)
    {
        echo $productId;
    } 

    public function destroy($productId)
    {
        return $this->productService->delete($productId);
    }  
}
