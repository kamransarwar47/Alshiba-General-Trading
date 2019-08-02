<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Products_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_all_product_images($id)
	{
		$this->db->select('product_image');
		$this->db->where('product_id', $id);
		$result = $this->db->get('product_images');

		return $result;
	}

	function get_all_product_downloads($id)
	{
		$this->db->select('file_title, product_file');
		$this->db->where('product_id', $id);
		$result = $this->db->get('product_downloads');

		return $result;
	}

	function get_product_details($id)
	{
		$this->db->select('product.id AS id, category.id AS cat_id, category_name, category_url_name, product_title, product_description, product_model, product_features, product_specifications');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->where('product.id', $id);
		$result = $this->db->get('product');

		return $result;
	}

	function get_related_category_products($id)
	{
		$this->db->select('product_image, product_title, category_name, product_url_name');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->join('product_images', 'product_images.product_id = product.id');
		$this->db->where('product_images.is_featured', 1);
		$this->db->where('product.product_category_id', $id);
		$this->db->where('product.product_status', 1);
		$this->db->order_by('product.id', 'desc');
		$this->db->limit(8);
		$result = $this->db->get('product');

		return $result;
	}
}