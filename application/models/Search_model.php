<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Search_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_products_by_search($input_text)
	{
		$this->db->select('category_name, product_title, product_url_name, product_image');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		$this->db->where("(product.product_title LIKE '%$input_text%' ESCAPE '!' OR product.product_model LIKE '%$input_text%' ESCAPE '!')");
		$this->db->where('product.product_status', 1);
		$this->db->where('product_images.is_featured', 1);
		$result = $this->db->get('product');

		return $result;
	}
}