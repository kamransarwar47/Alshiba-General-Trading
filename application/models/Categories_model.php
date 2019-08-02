<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Categories_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_category_details($id)
	{
		$this->db->select('category_name, category_description');
		$this->db->where('id', $id);
		$result = $this->db->get('category');

		return $result;
	}

	function get_all_products_by_category($id, $name = '', $brand = '')
	{
		$this->db->select('category_name, product_title, product_url_name, product_image');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		if (!empty($name)) {
			$this->db->where("(product.product_title LIKE '%$name%' ESCAPE '!' OR product.product_model LIKE '%$name%' ESCAPE '!')");
		}
		if (!empty($brand)) {
			$this->db->where('product.product_brand_id', $brand);
		}
		$this->db->where('product.product_category_id', $id);
		$this->db->where('product.product_status', 1);
		$this->db->where('product_images.is_featured', 1);
		$result = $this->db->get('product');

		return $result;
	}
}