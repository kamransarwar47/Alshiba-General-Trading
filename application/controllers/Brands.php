<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Brands extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('brands_model');
	}

	public function products($name = '')
	{
		$data['title']            = 'Brands - Al Shiba General Trading';
		$data['active_tab']       = 'brands';
		$id                       = get_id_by_url_name('brand', ['brand_url_name' => $name]);
		$data['brand_id']         = $id;
		$data['categories']       = $this->brands_model->get_all_categories_by_brands($id);
		$data['brands']           = $this->brands_model->get_all_active_brands(['brand_name', 'id']);
		$data['brand_details']    = $this->brands_model->get_brand_detail($id, ['brand_name', 'brand_description',
																				'brand_image', 'brand_header_image']);
		$data['products_listing'] = $this->brands_model->get_products_by_brands($id);
		$data['content']          = $this->load->view('brands', $data, true);
		$this->load->view('templates/template', $data);
	}

	public function brand_product_listing()
	{
		$data        = '';
		$brand_id    = explode(',', $this->input->post('brand_id'));
		$category_id = $this->input->post('category_id');
		$result      = $this->brands_model->get_products_by_brands_category($brand_id, $category_id);
		if ($result->num_rows() > 0) {
			foreach ($result->result_array() as $row) {
				$data .= '<div class="card">
							<div class="col-xs-12 col-md-5 noPadLR img-w">
								<img src="' . base_url() . 'uploads/products/' . $row['product_image'] . '"
									 class="center-block">
							</div>

							<div class="col-xs-12 col-md-7 item-details-w">
								<div class="row text-w">
									<div class="col-xs-12 col-md-12 noPadLR">
										<h2 class="h3 text-red fBold noMarT"><a
												href="' . site_url() . 'products/details/' . $row['product_url_name'] . '"
												class="item-name">' . strtoupper($row['product_title']) . '</a>
										</h2>
										<p class="">' . $row['product_description'] . '</p>
									</div>
								</div>

								<div class="row item-footer">
									<div class="col-md-6 hidden-xs hidden-sm text-center">
									<span
										class="text-gray fThin upper">' . strtoupper($row['category_name']) . '</span>
									</div>

									<div class="col-xs-12 col-md-6 noPadLR text-center">
										<a href="javascript:;" id="' . $row['id'] . '"
										   class="upper fBold addToCart">
											<i class="fa fa-cart-plus animate" aria-hidden="true"></i>
											&nbsp;&nbsp;&nbsp;Add to Enquiry Cart
										</a>
									</div>
								</div>
							</div>
						</div>';
			}
		}
		echo $data;
	}
}
