<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Class Product_model
 */
class Product_model extends CI_Model
{
	/**
	 * Product_model constructor.
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param string $id
	 * @return mixed
	 */
	function get($id = '')
	{
		$where['product_status!='] = 2;
		if (!empty($id)) {
			$where['product.id'] = $id;
		}
		$this->db->select('*,product.id as product_id');
		$this->db->where($where);
		$this->db->join('brand', 'brand.id=product.product_brand_id');
		$this->db->join('category', 'category.id=product.product_category_id');

		return $this->db->get('product');
	}

	/**
	 * @param        $product_id
	 * @param string $file_id
	 * @return mixed
	 */
	function get_download_files($product_id, $file_id = '')
	{
		$where['product_id'] = $product_id;
		if (!empty($file_id)) {
			$where['id'] = $file_id;
		}
		$this->db->select('*');
		$this->db->where('product_id', $product_id);

		return $this->db->get('product_downloads');
	}

	function get_max_product_mark_number()
	{
		$this->db->select('MAX(product_mark_number) AS max_number');

		return $this->db->get('product');
	}

	function latest_products_count()
	{
		$this->db->select('COUNT(id) AS total_count');
		$this->db->where('product_mark_number >', 0);

		return $this->db->get('product');
	}

	function get_latest_products()
	{
		$this->db->select('id, product_mark_number, product_title');
		$this->db->where('product_mark_number >', 0);
		$this->db->where('product_status', 1);
		$this->db->order_by('product_mark_number');
		$this->db->limit(8, 0);

		return $this->db->get('product');
	}

	function get_next_shift_number($number, $shift)
	{
		$this->db->select('id, product_mark_number');
		if ($shift == 'up') {
			$this->db->where('product_mark_number <', $number);
			$this->db->order_by('product_mark_number', 'DESC');
			$this->db->limit(1, 0);
		}
		if ($shift == 'down') {
			$this->db->where('product_mark_number >', $number);
			$this->db->order_by('product_mark_number', 'ASC');
			$this->db->limit(1, 0);
		}

		return $this->db->get('product');
	}
}