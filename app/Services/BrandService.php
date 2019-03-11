<?php

namespace App\Services;

use App\Services\WoocommerceService;

class BrandService  
{
	public $wooService;

	public function __construct(WoocommerceService $wooService) 
	{
		$this->wooService = $wooService;
	}

	public function getBrands() 
	{
		$brands = $this->wooService->getBrands();

        $data = [];
	    foreach ($brands as $brand) {
	    	$tmp['id'] = $brand->term_id;
	        $tmp['name'] = $brand->name;
	        $data[] = $tmp;
	    }
	   
	    return $data;
	}
	
	public function create($formData) 
	{
		$response = [
			'success' => false,
			'msg' => 'Failed'
		];

		$name = $formData['name'];
		$slug =  str_replace(' ', '-', strtolower($name));
		$taxonomy = 'yith_product_brand';

    	try {
    		$this->wooService->createBrand($name, $slug, $taxonomy);
    		return response()->json([
    			'success' => true,
    			'msg' => 'Success'
    		]);
    	} catch (\Exception $e) {
	    	return response()->json($response);
	    }
	}

	public function update($brandId, $formData) 
	{
		$response = [
			'success' => false,
			'msg' => 'Failed'
		];

		$name = $formData['name'];
		$slug =  str_replace(' ', '-', strtolower($name));

    	try {
    		$this->wooService->updateBrand($brandId, $name, $slug);
    		return response()->json([
    			'success' => true,
    			'msg' => 'Success'
    		]);
    	} catch (\Exception $e) {
	    	return response()->json($response);
	    }
	}

	public function delete($brandId)
	{
		$response = [
            'title' => 'Failed',
            'msg' => 'Failed to delete brand!',
            'type' => 'error'
        ];

		try {
	    	$this->wooService->deleteBrand($brandId);
	        $response['title'] = 'Deleted';
	        $response['msg'] = 'Brand has been deleted!';
	        $response['type'] = 'success';
	    } catch (\Exception $e) {
	    	return response()->json($response);
	    }

	    return $response;
	}
}	