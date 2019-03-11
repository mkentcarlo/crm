<?php

namespace App\Services;

use App\Services\WoocommerceService;

class CategoryService  
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

	public function getCategories() 
	{
		$categories = $this->wooService->getCategories();

        $data = [];
	    foreach ($categories as $category) {
	    	$tmp['id'] = $category->term_id;
	        $tmp['name'] = $category->name;
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

		$categoryData = ['name' => $formData['name'], 'slug' => str_replace(' ', '-', strtolower($formData['name']))];
		$data = [
			'product_category' => $categoryData
		];

    	try {
    		$this->wooService->process()->post('products/categories', $data);
    		return response()->json([
    			'success' => true,
    			'msg' => 'Success'
    		]);
    	} catch (\Exception $e) {
	    	return response()->json($response);
	    }
	}

	public function update($categoryId, $formData) 
	{
		$response = [
			'success' => false,
			'msg' => 'Failed'
		];

		$categoryData = ['name' => $formData['name'], 'slug' => str_replace(' ', '-', strtolower($formData['name']))];
		$data = [
			'product_category' => $categoryData
		];

    	try {
    		$this->wooService->process()->put('products/categories/' . $categoryId, $data);
    		return response()->json([
    			'success' => true,
    			'msg' => 'Success'
    		]);
    	} catch (\Exception $e) {
	    	return response()->json($response);
	    }
	}

	public function delete($categoryId)
	{
		$response = [
            'title' => 'Failed',
            'msg' => 'Failed to delete category!',
            'type' => 'error'
        ];

		try {
	    	$this->wooService->process()->delete('products/categories/'. $categoryId);
	        $response['title'] = 'Deleted';
	        $response['msg'] = 'Category has been deleted!';
	        $response['type'] = 'success';
	    } catch (\Exception $e) {
	    	return response()->json($response);
	    }

	    return $response;
	}
}	