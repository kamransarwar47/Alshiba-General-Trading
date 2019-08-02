<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_model');
	}

	public function details($name = '')
	{
		$data['title']             = 'Single Product - Al Shiba General Trading';
		$data['active_tab']        = 'products';
		$id                        = get_id_by_url_name('product', ['product_url_name' => $name]);
		$data['product_images']    = $this->products_model->get_all_product_images($id);
		$data['product_downloads'] = $this->products_model->get_all_product_downloads($id);
		$data['product_details']   = $this->products_model->get_product_details($id)->result_array();
		$data['related_products']  = $this->products_model->get_related_category_products($data['product_details'][0]['cat_id']);
		$data['content']           = $this->load->view('products', $data, true);
		$this->load->view('templates/template', $data);
	}
}
