<?php

namespace App\Services;

use Automattic\WooCommerce\Client;
use DB;

class WoocommerceService 
{
	public function process()
	{
		return new Client(
		    config('woocommerce.store_url'), 
		    config('woocommerce.consumer_key'), 
		    config('woocommerce.consumer_secret'),
		    [
		        'wp_api' => config('woocommerce.wp_api'),
		        'version' => config('woocommerce.api_version'),
		        'query_string_auth' => config('woocommerce.query_string_auth'),
		    ]
		);
	}

	public function get_file_dir($img_file) 
	{
		$split = explode('/', $img_file);
		$keys = array_keys($split);
	    $end_key = end($keys);
	    unset($split[$end_key]);

	    return implode('/', $split);
	}

	public function get_image_path($base_url, $size, $img_file) 
	{
	    if($img_file) {
	        $img_sub_dir = $this->get_file_dir($img_file['file']);
	        if ($size != "default" && !empty($img_file['sizes'][$size])) {
	        
	            $img = $img_sub_dir. '/'. $img_file['sizes'][$size]['file'];
	        } else {
	            $img = $img_file['file'];
	        }

	        return $base_url .'/'. $img;
	    }

	    return null;
	}

	public function getCategories()
	{
		return DB::select("SELECT wpla_terms.* FROM wpla_terms LEFT JOIN wpla_term_taxonomy ON(wpla_terms.term_id = wpla_term_taxonomy.term_id) LEFT JOIN wpla_posts ON(wpla_posts.ID = wpla_terms.term_id) WHERE wpla_term_taxonomy.taxonomy = 'product_cat'");
	}

	public function getBrands()
	{
		return DB::select("SELECT wpla_terms.* FROM wpla_terms LEFT JOIN wpla_term_taxonomy ON(wpla_terms.term_id = wpla_term_taxonomy.term_id) WHERE wpla_term_taxonomy.taxonomy = 'yith_product_brand'");
	}

	public function getProducts()
	{
		return DB::select("SELECT DISTINCT wposts.*, wm2.meta_value as images, wm3.meta_value as regular_price, wm4.meta_value as sale_price, wm4.meta_value as price, wpo.option_value as siteurl FROM wpla_posts wposts JOIN wpla_options wpo ON wpo.option_name = 'siteurl' LEFT JOIN wpla_postmeta wm1 ON (wposts.ID = wm1.post_id AND wm1.meta_value IS NOT NULL AND wm1.meta_key = '_thumbnail_id') LEFT JOIN wpla_postmeta wm2 ON (wm1.meta_value = wm2.post_id AND wm2.meta_key = '_wp_attachment_metadata' AND wm2.meta_value IS NOT NULL) LEFT JOIN wpla_postmeta wm3 ON (wposts.ID = wm3.post_id AND wm3.meta_key = '_regular_price' AND wm3.meta_value IS NOT NULL) LEFT JOIN wpla_postmeta wm4 ON (wposts.ID = wm4.post_id AND wm4.meta_key = '_sale_price' AND wm4.meta_value IS NOT NULL) LEFT JOIN wpla_postmeta wm5 ON (wposts.ID = wm5.post_id AND wm5.meta_key = '_price' AND wm5.meta_value IS NOT NULL) LEFT JOIN wpla_term_relationships ON (wposts.ID = wpla_term_relationships.object_id) LEFT JOIN wpla_term_taxonomy ON (wpla_term_relationships.term_taxonomy_id = wpla_term_taxonomy.term_taxonomy_id) WHERE wposts.post_type = 'product' AND wposts.post_status = 'publish'");
	}

	public function getProductCategories($productId)
	{
		return DB::select("SELECT DISTINCT wpla_terms.* FROM wpla_posts LEFT JOIN wpla_term_relationships ON(wpla_posts.ID = wpla_term_relationships.object_id) LEFT JOIN wpla_term_taxonomy ON(wpla_term_relationships.term_taxonomy_id = wpla_term_taxonomy.term_taxonomy_id) LEFT JOIN wpla_terms ON(wpla_term_taxonomy.term_id = wpla_terms.term_id) WHERE wpla_term_taxonomy.taxonomy = 'product_cat' AND wpla_posts.ID =". $productId);
	}

	public function getProductBrands($productId)
	{
		return DB::select("SELECT DISTINCT wpla_terms.* FROM wpla_posts LEFT JOIN wpla_term_relationships ON(wpla_posts.ID = wpla_term_relationships.object_id) LEFT JOIN wpla_term_taxonomy ON(wpla_term_relationships.term_taxonomy_id = wpla_term_taxonomy.term_taxonomy_id) LEFT JOIN wpla_terms ON(wpla_term_taxonomy.term_id = wpla_terms.term_id) WHERE wpla_term_taxonomy.taxonomy = 'yith_product_brand' AND wpla_posts.ID =". $productId);
	}

	public function updateProductBrand($productId, $currentBrandId, $brandId)
	{
		return DB::select("UPDATE wpla_term_relationships SET term_taxonomy_id='$brandId' WHERE object_id = '$productId' AND term_taxonomy_id= '$currentBrandId'");
	}

	public function createProductBrand($productId, $brandId)
	{
		return DB::insert("INSERT INTO wpla_term_relationships (object_id, term_taxonomy_id,term_order) values (?, ?, ?)", [$productId, $brandId, 0]);
	}

	public function createBrand($name, $slug, $taxonomy)
	{
		$inserted = DB::insert("INSERT INTO wpla_terms (name, slug,term_group) values (?, ?, ?)", [$name, $slug, 0]);
		
		if ($inserted) {
			$id = DB::getPdo()->lastInsertId();
			return DB::insert("INSERT INTO wpla_term_taxonomy (term_id, taxonomy,description, parent, count) values (?, ?, ?, ?, ?)", [$id, $taxonomy, '', 0, 0]);
		}

		return false;
	}

	public function updateBrand($brandId, $name, $slug)
	{
		return DB::update("UPDATE wpla_terms set name = '$name', slug='$name' where term_id = ?", [$brandId]);
	}

	public function deleteBrand($brandId)
	{
		$deleted = DB::delete("DELETE FROM wpla_terms WHERE term_id =?", [$brandId]);

		if ($deleted) {
			return DB::delete("DELETE FROM wpla_term_taxonomy WHERE term_id =?", [$brandId]);
		}

		return false;
	}

	public function getBrand($brandId)
	{
		return DB::select("SELECT * FROM wpla_terms WHERE term_id=". $brandId);
	}
}	
