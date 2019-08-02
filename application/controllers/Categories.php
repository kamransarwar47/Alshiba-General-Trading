<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('categories_model');
	}

	public function products($name = '')
	{
		$data['title']            = 'Products - Al Shiba General Trading';
		$data['active_tab']       = 'products';
		$id                       = get_id_by_url_name('category', ['category_url_name' => $name]);
		$data['category_id']      = $id;
		$data['category_details'] = $this->categories_model->get_category_details($id)->result_array();
		$data['all_brands']       = $this->common_model->get('brand', ['brand_status' => 1], ['id', 'brand_name']);
		$data['all_products']     = $this->categories_model->get_all_products_by_category($id);
		$data['content']          = $this->load->view('categories', $data, true);
		$this->load->view('templates/template', $data);
	}

	public function categories_product_listing()
	{
		$data          = '';
		$category_id   = $this->input->post('category_id');
		$brand_id      = $this->input->post('brand_id');
		$product_title = $this->input->post('product_title');
		$result        = $this->categories_model->get_all_products_by_category($category_id, $product_title, $brand_id);
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
				$data .= '<div class="col-md-3 col-xs-6">
					<a href="' . site_url() . 'products/details/' . $row['product_url_name'] . '" class="boxed">
						<img src="' . base_url() . 'uploads/products/' . $row['product_image'] . '"
							 class="img-responsive center-block">
						<h3 class="h4 text-red fBold">' . ucwords($row['product_title']) . '</h3>
						<p class="text-gray fThin upper">' . strtoupper($row['category_name']) . '</p>
					</a>
				</div>';
			}
		}
		echo $data;
	}
}
