<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Services\ProductService;
use App\Services\WooCommerceService;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;

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
        $categories = $this->wooService->getCategories();
        $brands = $this->wooService->getBrands();

        return view('admin.products.index', compact('categories', 'brands'));
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
            $coverImage = app()->make('App\Services\ImageService')->getUploadedProductImg($request->file('cover_image'));
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
        if ($product) {
            $acf = DB::select("SELECT * FROM wpla_postmeta where post_id =".$productId);
            $arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition'];
            foreach ($acf as $row) {
                if (in_array($row->meta_key,  $arr)) {
                    $key = $row->meta_key;
                    $product->$key = $row->meta_value;
                }
            }
            
        }

        $product->categories = $this->wooService->getProductCategories($productId);
        $product->brands = $this->wooService->getProductBrands($productId);

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    } 

    public function update($productId, ProductFormRequest $request)
    {
        $coverImage = '';
        if ($request->hasFile('cover_image')) {
            // upload image
            $coverImage = app()->make('App\Services\ImageService')->getUploadedProductImg($request->file('cover_image'));
        }
        $formData = $request->all();
        $formData['cover_image'] = $coverImage;
        
        return $this->productService->update($productId, $formData);
    } 

    public function show($productId)
    {
        $product = $this->wooService->process()->get('products/'. $productId)->product;
        $product->category_id = $this->wooService->getProductCategories($productId)[0];
        $product->brand_id = $this->wooService->getProductBrands($productId)[0];

        return response()->json($product);
    } 

    public function destroy($productId)
    {
        return $this->productService->delete($productId);
    }  
}
