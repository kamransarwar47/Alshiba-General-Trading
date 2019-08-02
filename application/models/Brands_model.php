<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Brands_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_brand_detail($id, $fields = '*')
	{
		$this->db->select($fields);
		$this->db->where('id', $id);
		$result = $this->db->get('brand');

		return $result;
	}

	function get_all_active_brands($fields = '*')
	{
		$this->db->select($fields);
		$this->db->where('brand_status', 1);
		$result = $this->db->get('brand');

		return $result;
	}

	function get_all_categories_by_brands($id)
	{
		$this->db->select('category_name, category.id AS id');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->where('product.product_brand_id', $id);
		$this->db->where('category.category_status', 1);
		$this->db->group_by('product.product_category_id');
		$result = $this->db->get('product');

		return $result;
	}

	function get_products_by_brands($id)
	{
		$this->db->select('category_name, product.id AS id, product_title, product_description, product_image, product_url_name');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		$this->db->where('product.product_brand_id', $id);
		$this->db->where('product.product_status', 1);
		$this->db->where('product_images.is_featured', 1);
		$result = $this->db->get('product');

		return $result;
	}

	function get_products_by_brands_category($brand_id, $category_id)
	{
		$this->db->select('category_name, product.id AS id, product_title, product_description, product_image, product_url_name');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		$this->db->where_in('product.product_brand_id', $brand_id);
		$this->db->where('product.product_status', 1);
		if ($category_id > 0) {
			$this->db->where('product.product_category_id', $category_id);
		}
		$this->db->where('product_images.is_featured', 1);
		$result = $this->db->get('product');

		return $result;
	}
}