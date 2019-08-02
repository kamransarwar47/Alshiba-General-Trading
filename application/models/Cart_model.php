<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Cart_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function add_cart($data)
	{
		$this->db->select('id, product_quantity');
		$this->db->where('user_id', $data['user_id']);
		$this->db->where('product_id', $data['product_id']);
		$result = $this->db->get('cart');
		if ($result->num_rows() > 0) {
			$id       = $result->result_array()[0]['id'];
			$quantity = $result->result_array()[0]['product_quantity'];
			$quantity += 1;
			$this->db->update('cart', ['product_quantity' => $quantity], ['id' => $id]);

			return true;
		} else {
			$this->db->insert('cart', $data);
			if ($this->db->affected_rows() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

	function get_all_cart_products($user_id)
	{
		$this->db->select('cart.id AS id, product_quantity, product_title, product_model, product_image, product_url_name');
		$this->db->join('product', 'cart.product_id = product.id');
		$this->db->join('product_images', 'product.id = product_images.product_id');
		$this->db->where('product_images.is_featured', 1);
		$this->db->where('cart.user_id', $user_id);
		$result = $this->db->get('cart');

		return $result;
	}

	function get_cart_products_for_insert($user_id)
	{
		$this->db->select('product.id AS product_id, brand.id AS brand_id, category.id AS category_id, product_title, product_model, brand_name AS brand_title, category_name AS category_title, cart.product_quantity AS product_quantity');
		$this->db->join('product', 'cart.product_id = product.id');
		$this->db->join('brand', 'product.product_brand_id = brand.id');
		$this->db->join('category', 'product.product_category_id = category.id');
		$this->db->where('cart.user_id', $user_id);
		$result = $this->db->get('cart');

		return $result;
	}
}