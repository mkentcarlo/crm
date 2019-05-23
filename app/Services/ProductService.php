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
	    	$selling = $this->wooService->getProductSellingById($product->ID);
			$buying = $this->wooService->getProductBuyingById($product->ID);
			$asking = $this->wooService->getProductAskingById($product->ID);

	    	$img_file = @unserialize($product->images);
	    	$img_dir  = $product->siteurl .'/wp-content/uploads';
            $img_path = $this->wooService->get_image_path($img_dir, 'thumbnail', $img_file);
	        $tmp['id'] = $product->ID;
	        $tmp['name'] = $product->post_title;
	        $tmp['short_description'] = $product->post_excerpt;
	        $tmp['img_path'] = $img_path;
	        $tmp['categories'] = implode('', array_column($this->wooService->getProductCategories($product->ID), 'name'));
	        $tmp['brands'] = implode('', array_column($this->wooService->getProductBrands($product->ID), 'name'));
	        $tmp['price'] = $product->price;
	        $tmp['selling_price'] = ($selling) ? $selling[0]->meta_value : '0.00';
			$tmp['buying_price'] = ($buying) ? $buying[0]->meta_value : '0.00';
			$tmp['asking_price'] = ($asking) ? $asking[0]->meta_value : '0.00';
	        $tmp['status'] = $product->post_status == 'publish' ? 'published' : $product->post_status;
			$tmp['date_created'] = date('d/m/Y | h:i a', strtotime($product->post_date));
			$tmp['acf_search'] = "";
			$acf = DB::select("SELECT * FROM wpla_postmeta where post_id =".$product->ID);
            $arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition', 'complication', 'cost_price', 'asking_price', 'selling_price', 'buying_price', 'model_reference'];
            foreach ($acf as $row) {
                if (in_array($row->meta_key,  $arr)) {
                    $key = $row->meta_key;
					$product->$key = $row->meta_value;
					$tmp['acf_search'].="|".$row->meta_value;
                }
            }
	        $data[] = $tmp;
	    }
	   
	    return $data;
	}
	
	public function getProducts2() 
	{
		$products = $this->wooService->getProducts2();
        $data = [];
	    foreach ($products as $product) {
	    	$selling = $this->wooService->getProductSellingById($product->ID);
			$buying = $this->wooService->getProductBuyingById($product->ID);
			$asking = $this->wooService->getProductAskingById($product->ID);

	    	$img_file = @unserialize($product->images);
	    	$img_dir  = $product->siteurl .'/wp-content/uploads';
            $img_path = $this->wooService->get_image_path($img_dir, 'thumbnail', $img_file);
	        $tmp['id'] = $product->ID;
	        $tmp['name'] = $product->post_title;
	        $tmp['short_description'] = $product->post_excerpt;
	        $tmp['img_path'] = $img_path;
	        $tmp['categories'] = implode('', array_column($this->wooService->getProductCategories($product->ID), 'name'));
	        $tmp['brands'] = implode('', array_column($this->wooService->getProductBrands($product->ID), 'name'));
	        $tmp['price'] = $product->price;
	        $tmp['selling_price'] = ($selling) ? $selling[0]->meta_value : '0.00';
			$tmp['buying_price'] = ($buying) ? $buying[0]->meta_value : '0.00';
			$tmp['asking_price'] = ($asking) ? $asking[0]->meta_value : '0.00';
	        $tmp['status'] = $product->post_status == 'publish' ? 'published' : $product->post_status;
			$tmp['date_created'] = date('d/m/Y | h:i a', strtotime($product->post_date));
			$tmp['acf_search'] = "";
			$acf = DB::select("SELECT * FROM wpla_postmeta where post_id =".$product->ID);
            $arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition', 'complication', 'cost_price', 'asking_price', 'selling_price', 'buying_price', 'model_reference'];
            foreach ($acf as $row) {
                if (in_array($row->meta_key,  $arr)) {
                    $key = $row->meta_key;
					$product->$key = $row->meta_value;
					$tmp['acf_search'].="|".$row->meta_value;
                }
            }
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
    	
    	$arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition', 'complication', 'cost_price', 'asking_price', 'selling_price','buying_price', 'model_reference','reserve'];

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
		$arr = ['model_reference', 'condition', 'gnder', 'case_material', 'bezel', 'case_back', 'case_diameter', 'movement', 'watch_features', 'dial_colour', 'crystal', 'braceletstrap', 'clasp_type', 'included', 'complication', 'new', 'limited_edition', 'complication', 'cost_price', 'asking_price', 'selling_price', 'buying_price', 'model_reference','reserve'];

		foreach ($formData as $key => $value) {
			if(in_array($key, $arr)) {
				DB::update('UPDATE wpla_postmeta set meta_value = "'.$value.'" where meta_key="'.$key.'" AND post_id = "'.$productId.'"');
			}
		}

		foreach ($arr as $value) {
			$exist = DB::select("SELECT meta_key FROM wpla_postmeta WHERE meta_key='$value' AND post_id = '$productId'");

			if (!$exist) {
				DB::insert("INSERT INTO wpla_postmeta (meta_key, meta_value,post_id) values (?, ?, ?)", [$value, $formData[$value], $productId]);
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
		$productData['managing_stock'] = false;
		// $productData['in_stock'] = true;

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
