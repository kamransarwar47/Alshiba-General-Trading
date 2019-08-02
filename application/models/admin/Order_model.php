<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Class Order_model
 */
class Order_model extends CI_Model
{
	/**
	 * Order_model constructor.
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param string $id
	 * @return mixed
	 */
	function order_detail($id)
	{
		$where['orders.id'] = $id;
		$select             = ['orders.*',
							   'order_details.product_id',
							   'order_details.product_title',
							   'order_details.product_model',
							   'order_details.brand_title',
							   'order_details.category_title',
							   'order_details.product_quantity',];
		$this->db->select($select);
		$this->db->where($where);
		$this->db->join('order_details', 'order_details.orders_id=orders.id');

		return $this->db->get('orders');
	}
}