<?php

namespace App\Services;

use App\Services\WoocommerceService;
use DB;

class ProductService  
{
	protected static $exceptProperties = [
	    '_method',
	    '_token'       
	];

	public $wooService;

	public function __construct(WoocommerceService $wooService) 
	{
		$this->wooService = $wooService;
	}

	public function getProducts() 
	{
		$products = $this->wooService->getProducts();
        $data = [];
	    foreach ($products as $product) {
	    	$img_file = @unserialize($product->images);
	    	$img_dir  = $product->siteurl .'wp-content/uploads';
            $img_path = $this->wooService->get_image_path($img_dir, 'thumbnail', $img_file);
	        $tmp['id'] = $product->ID;
	        $tmp['name'] = $product->post_title;
	        $tmp['img_path'] = $img_path;
	        $tmp['categories'] = implode('', array_column($this->wooService->getProductCategories($product->ID), 'name'));
	        $tmp['brands'] = implode('', array_column($this->wooService->getProductBrands($product->ID), 'name'));
	        $tmp['price'] = $product->price;
	        $tmp['status'] = $product->post_status;
	        $tmp['date_created'] = date('M d Y h:i a', strtotime($product->post_date));
	        $data[] = $tmp;
	    }
	   
	    return $data;
	}
	
	public function create($formData) 
	{
		$productImages = [];
		if ($formData['cover_image'] != '') {
            $productImages[] = [
				'src' => asset('storage/product-images').'/'. $formData['cover_image'],
				'position' => 0
			];
        } 

        $files = json_decode($formData['img_content']);

        foreach($files as $key => $value) {
            $index = $key + 1;
            $filename = app()->make('App\Services\CustomService')->createImageFromBase64($value, $key);
            $productImages[] = [
                'src' => asset('storage/product-images').'/'. $filename,
                'position' => $index
            ];
        }    

		$productData = self::setFormData($formData, self::$exceptProperties);
		$productData['categories'] = ['id' => $productData['category_id']];
		$productData['images'] = $productImages;
		$productData['featured'] = true;
		$productData['managing_stock'] = true;
		$productData['in_stock'] = true;

        $data = [
    		'product' => $productData
    	];		

    	$created = $this->wooService->process()->post('products', $data);
    	
		$this->wooService->createProductBrand($created->product->id, $productData['brand_id']);
    	
    	$arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition', 'complication', 'cost_price', 'asking_price', 'selling_price', 'model_reference'];

		foreach ($formData as $key => $value) {
			if(in_array($key, $arr)) {
				DB::insert("INSERT INTO wpla_postmeta (post_id, meta_key, meta_value) values (?, ?, ?)", [$created->product->id, $key, $value]);
			}
		}

    	if ($created) {
    		return response()->json([
    			'success' => true,
    			'msg' => 'Success'
    		]);
    	}

    	return response()->json([
			'success' => false,
			'msg' => 'Failed'
		]);
	}

	public function update($productId, $formData) 
	{
		
		$product = $this->wooService->process()->get('products/'. $productId)->product;
		
		if (empty($product)) {
			return null;
		}
		$arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition', 'complication', 'cost_price', 'asking_price', 'selling_price', 'model_reference'];

		foreach ($formData as $key => $value) {
			if(in_array($key, $arr)) {
				DB::update("UPDATE wpla_postmeta set meta_value = '$value' where meta_key='$key' AND post_id = '$productId'");
			}
		}

		$img_ids = json_decode($formData['img_ids']);
	
        foreach ($product->images as $key => $value) {

        	$product->images[$key] = (array) $value;

            if($product->images[$key]['position'] == 0) {
                if ($formData['cover_image'] != '') {
                    $product->images[] = [
    					'src' => $formData['cover_image'],
    					'position' => 0
    				];
                } 
                continue;
            } else {
            	if (!in_array($product->images[$key]['id'], $img_ids)) {
	                unset($product->images[$key]);
	            }
            }    
        }

        $lastImage = end($product->images);
        $files = json_decode($formData['img_content']);

        foreach($files as $key => $value) {
            $index = $key + 1;
            $filename = app()->make('App\Services\CustomService')->createImageFromBase64($value, $key);
            $product->images[] = [
                'src' => asset('storage/product-images').'/'. $filename,
                'position' => $lastImage['position'] + $index
            ];
        }    

		$productData = self::setFormData($formData, self::$exceptProperties);
		$productData['categories'] = ['id' => $productData['category_id']];
		$productData['images'] = $product->images;
		$productData['featured'] = true;
		$productData['managing_stock'] = true;
		$productData['in_stock'] = true;

        $data = [
    		'product' => $productData
    	];		

    	$updated = $this->wooService->process()->put('products/'. $productId, $data);
    	$brand = array_column($this->wooService->getProductBrands($productId), 'term_id');
		$this->wooService->updateProductBrand($productId, $brand[0], $productData['brand_id']);
    	
    	if ($updated) {
    		return response()->json([
    			'success' => true,
    			'msg' => 'Success'
    		]);
    	}

    	return response()->json([
			'success' => false,
			'msg' => 'Failed'
		]);
	}

	public function delete($productId)
	{
		$response = [
            'title' => 'Failed',
            'msg' => 'Failed to delete product!',
            'type' => 'error'
        ];

		try {
	    	$this->wooService->process()->delete('products/'. $productId, ['force' => true]);
	        $response['title'] = 'Deleted';
	        $response['msg'] = 'Product has been deleted!';
	        $response['type'] = 'success';
	    } catch (\Exception $e) {
	    	return response()->json($response);
	    }

	    return $response;
	}

	protected static function formatProductData($formData)
	{
		$formData['sale_price'] = (isset($formData['sale_price']) && $formData['sale_price'] > 0) ? $formData['sale_price'] : $formData['regular_price'];
		return $formData;
	}

	public static function setFormData($formData, $exceptProperties = [])
	{
	    foreach ($formData as $key => $value) {
	      	if (in_array($key, $exceptProperties)) {
	        	unset($formData[$key]);
	      	}
	    }
	    return $formData;
	}
}	
