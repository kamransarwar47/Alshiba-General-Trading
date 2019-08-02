<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Home_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_latest_products()
	{
		$this->db->select('product_title, category_name, product_image, product_url_name');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		$this->db->where('product_images.is_featured = 1');
		$this->db->where('product.product_mark_number >', 0);
		$this->db->where('product.product_status', 1);
		$this->db->order_by('product.product_mark_number', 'ASC');
		$this->db->limit(8);
		$result = $this->db->get('product');

		return $result;
	}

	function get_new_arrival()
	{
		$this->db->select('product_title, product_description, product_image, product_url_name');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		$this->db->where('product_images.is_featured = 1');
		$this->db->where('product.product_new_arrival >', 0);
		$this->db->where('product.product_status', 1);
		$result = $this->db->get('product');

		return $result;
	}
}