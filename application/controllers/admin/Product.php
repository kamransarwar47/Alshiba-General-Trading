<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Product
 */
class Product extends CI_Controller
{
	private $width              = 360;
	private $height             = 265;
	private $admin_width        = 100;
	private $admin_height       = 75;
	private $new_arrival_width  = 598;
	private $new_arrival_height = 318;

	/**
	 * Product constructor.
	 */
	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('admin/product_model');
	}

	function index()
	{
		$data['products']              = $this->product_model->get();
		$data['latest_products_count'] = $this->product_model->latest_products_count()->row()->total_count;
		$data['active']                = 'products';
		$data['content']               = $this->load->view('admin/products/listing', $data, true);
		$this->load->view('admin/templates/template', $data);
	}

	function add()
	{
		$this->form_validation->set_rules('product_title', 'Product Title', 'trim|required');
		$this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');
		$this->form_validation->set_rules('product_model', 'Product Model', 'trim|required');
		$this->form_validation->set_rules('product_features', 'Product features', 'trim|required');
		$this->form_validation->set_rules('product_specifications', 'product specifications', 'trim|required');
		$this->form_validation->set_rules('image', 'product specifications', 'trim|callback_validate_product');
		if ($this->form_validation->run() == false) {
			$where              = ['brand_status' => 1];
			$data['brands']     = $this->common_model->get('brand', $where);
			$where              = ['category_status' => 1];
			$data['categories'] = $this->common_model->get('category', $where);
			$data['active']     = 'products';
			$data['content']    = $this->load->view('admin/products/add', $data, true);
			$this->load->view('admin/templates/template', $data);
		} else {
			$product['product_brand_id']       = $this->input->post('product_brand_id');
			$product['product_category_id']    = $this->input->post('product_category_id');
			$product['product_title']          = $this->input->post('product_title');
			$product['product_description']    = $this->input->post('product_description');
			$product['product_model']          = $this->input->post('product_model');
			$product['product_features']       = $this->input->post('product_features');
			$product['product_specifications'] = str_replace('<table>', '<table class="table table-hover">', $this->input->post('product_specifications'));
			$product['product_time_date']      = time();
			$product['product_url_name']       = safe_url($product['product_title']);
			$product_id                        = $this->common_model->insert('product', $product);
			#===============================product images upload====================
			$files = $_FILES;
			$cpt   = count($_FILES['image']['name']);
			$time  = time();
			$image = [];
			for ($i = 0; $i < $cpt; $i++) {
				if ($i == 0)
					$is_featured = 1; else
					$is_featured = 0;
				$_FILES['image']['name']     = $files['image']['name'][$i];
				$_FILES['image']['type']     = $files['image']['type'][$i];
				$_FILES['image']['tmp_name'] = $files['image']['tmp_name'][$i];
				$_FILES['image']['error']    = $files['image']['error'][$i];
				$_FILES['image']['size']     = $files['image']['size'][$i];
				$config                      = ['upload_path'   => 'uploads/products/original',
												'allowed_types' => 'gif|jpg|png'];
				$file                        = file_upload_admin('image', $config);
				$data                        = ['source_path' => $file['full_path'],
												'target_path' => 'uploads/products/' . $file['file_name'],
												'width'       => $this->width,
												'height'      => $this->height];
				resize_image($data);
				$data = ['source_path' => $file['full_path'],
						 'target_path' => 'uploads/products/admin/admin_' . $file['file_name'],
						 'width'       => $this->admin_height,
						 'height'      => $this->admin_height];
				resize_image($data);
				$image[$i]['product_image']   = $file['file_name'];
				$image[$i]['product_id']      = $product_id;
				$image[$i]['is_featured']     = $is_featured;
				$image[$i]['image_time_date'] = $time;
			}
			if (count($image) > 0) {
				$this->common_model->insert_batch('product_images', $image);
			}
			set_message_admin('Product added successfully', 'success');
			redirect('admin/product');
		}
	}

	/**
	 * @return bool
	 */
	function validate_product()
	{
		$product_name              = $this->input->post('product_title');
		$safe_name                 = safe_url($product_name);
		$where['product_url_name'] = $safe_name;
		$result                    = $this->common_model->get('product', $where);
		if ($result->num_rows() > 0) {
			$this->form_validation->set_message('validate_product', 'Product name you enter is already exist');

			return false;
		}
		$valid_ext               = ['jpg', 'jpeg', 'png'];
		$_FILES['image']['name'] = array_filter($_FILES['image']['name']);
		if (!empty($_FILES['image']['name'])) {
			foreach ($_FILES['image']['name'] as $name)
				$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
			if (!in_array($ext, $valid_ext)) {
				$this->form_validation->set_message('validate_product', 'Please select valid images for product.');

				return false;
			}
		} else {
			$this->form_validation->set_message('validate_product', 'Product images are required');

			return false;
		}

		return true;
	}

	/**
	 * @param $id
	 */
	function edit($id)
	{
		$this->form_validation->set_rules('product_title', 'Product Title', 'trim|required');
		$this->form_validation->set_rules('product_description', 'Product Description', 'trim|required');
		$this->form_validation->set_rules('product_model', 'Product Model', 'trim|required');
		$this->form_validation->set_rules('product_features', 'Product features', 'trim|required');
		$this->form_validation->set_rules('product_specifications', 'product specifications', 'trim|required');
		$this->form_validation->set_rules('image', 'product specifications', 'trim|callback_validate_product_edit');
		if ($this->form_validation->run() == false) {
			$where              = ['brand_status' => 1];
			$data['brands']     = $this->common_model->get('brand', $where);
			$where              = ['category_status' => 1];
			$data['categories'] = $this->common_model->get('category', $where);
			$where              = ['product_id' => $id];
			$data['images']     = $this->common_model->get('product_images', $where);
			$data['product']    = $this->product_model->get($id);
			$data['product_id'] = $id;
			$data['active']     = 'products';
			$data['content']    = $this->load->view('admin/products/edit', $data, true);
			$this->load->view('admin/templates/template', $data);
		} else {
			$product['product_brand_id']       = $this->input->post('product_brand_id');
			$product['product_category_id']    = $this->input->post('product_category_id');
			$product['product_title']          = $this->input->post('product_title');
			$product['product_description']    = $this->input->post('product_description');
			$product['product_model']          = $this->input->post('product_model');
			$product['product_features']       = ($this->input->post('product_features'));
			$product['product_specifications'] = str_replace('<table>', '<table class="table table-hover">', $this->input->post('product_specifications'));
			$product['product_url_name']       = safe_url($product['product_title']);
			$where                             = ['id' => $id];
			$this->common_model->update('product', $product, $where);
			set_feature_image($id);
			#===============================product images upload====================
			$files = $_FILES;
			$cpt   = count($_FILES['image']['name']);
			$time  = time();
			$image = [];
			for ($i = 0; $i < $cpt; $i++) {
				$_FILES['image']['name']     = $files['image']['name'][$i];
				$_FILES['image']['type']     = $files['image']['type'][$i];
				$_FILES['image']['tmp_name'] = $files['image']['tmp_name'][$i];
				$_FILES['image']['error']    = $files['image']['error'][$i];
				$_FILES['image']['size']     = $files['image']['size'][$i];
				$config                      = ['upload_path'   => 'uploads/products/original',
												'allowed_types' => 'gif|jpg|png'];
				$file                        = file_upload_admin('image', $config);
				$data                        = ['source_path' => $file['full_path'],
												'target_path' => 'uploads/products/' . $file['file_name'],
												'width'       => $this->width,
												'height'      => $this->height];
				resize_image($data);
				$data = ['source_path' => $file['full_path'],
						 'target_path' => 'uploads/products/admin/admin_' . $file['file_name'],
						 'width'       => $this->admin_width,
						 'height'      => $this->admin_height];
				resize_image($data);
				$image[$i]['product_image']   = $file['file_name'];
				$image[$i]['product_id']      = $id;
				$image[$i]['image_time_date'] = $time;
			}
			if (count($image) > 0) {
				$this->common_model->insert_batch('product_images', $image);
			}
			set_message_admin('Product updated successfully', 'success');
			redirect('admin/product');
		}
	}

	/**
	 * @return bool
	 */
	function validate_product_edit()
	{
		$product_name              = $this->input->post('product_title');
		$product_id                = $this->input->post('product_id');
		$safe_name                 = safe_url($product_name);
		$where['id!=']             = $product_id;
		$where['product_url_name'] = $safe_name;
		$result                    = $this->common_model->get('product', $where);
		if ($result->num_rows() > 0) {
			$this->form_validation->set_message('validate_product_edit', 'Product name you enter is already exist');

			return false;
		}
		$valid_ext               = ['jpg', 'jpeg', 'png'];
		$_FILES['image']['name'] = array_filter($_FILES['image']['name']);
		if (!empty($_FILES['image']['name'])) {
			foreach ($_FILES['image']['name'] as $name)
				$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
			if (!in_array($ext, $valid_ext)) {
				$this->form_validation->set_message('validate_product_edit', 'Please select valid images for product.');

				return false;
			}
		}

		return true;
	}

	/**
	 * @param $id
	 */
	function delete($id)
	{
		if (is_numeric($id)) {
			$update['product_status'] = 2;
			$where['id']              = $id;
			$this->common_model->update('product', $update, $where);
			set_message_admin('Product deleted successfully', 'success');
		}
		redirect('admin/product');
	}

	/**
	 * @param $id
	 * @param $product_id
	 * @internal param $file_name
	 */
	function delete_image($id, $product_id)
	{
		if (is_numeric($id)) {
			$where['id'] = $id;
			$image_data  = $this->common_model->get('product_images', $where);
			$image_data  = $image_data->row();
			$file_name   = $image_data->product_image;
			$where['id'] = $id;
			$this->common_model->delete('product_images', $where);
			$old_file[] = 'uploads/products/original/' . urldecode($file_name);
			$old_file[] = 'uploads/products/' . urldecode($file_name);
			$old_file[] = 'uploads/products/admin/admin_' . urldecode($file_name);
			unlink_files($old_file);
			set_feature_image($product_id);
			set_message_admin('Product Image deleted successfully', 'success');
		}
		redirect('admin/product/edit/' . $product_id . '#images');
	}

	/**
	 * @param $id
	 * @param $status
	 */
	function change_status($id, $status)
	{
		if (is_numeric($id) && is_numeric($status)) {
			switch ($status) {
				case (1):
					$update['product_status'] = 1;
					break;
				default:
					$update['product_status'] = 0;
					break;
			}
			$where['id'] = $id;
			$this->common_model->update('product', $update, $where);
			set_message_admin('Product Status changed successfully', 'success');
		}
		redirect('admin/product');
	}


	#==============Product files management================
	/**
	 * @param $product_id
	 */
	function download_files($product_id)
	{
		$data['product_files'] = $this->product_model->get_download_files($product_id);
		$data['product_id']    = $product_id;
		$data['active']        = 'products';
		$data['content']       = $this->load->view('admin/products/download_file_listing', $data, true);
		$this->load->view('admin/templates/template', $data);
	}

	/**
	 * @param $product_id
	 */
	function add_file($product_id)
	{
		$this->form_validation->set_rules('file_title', 'file title', 'trim|required');
		$this->form_validation->set_rules('product_file', 'product file', 'trim|callback_validate_file');
		if ($this->form_validation->run() == false) {
			$data['product_id'] = $product_id;
			$data['active']     = 'products';
			$data['content']    = $this->load->view('admin/products/file_add', $data, true);
			$this->load->view('admin/templates/template', $data);
		} else {
			$file_data['product_id'] = $product_id;
			$file_data['file_title'] = $this->input->post('file_title');;
			$file_data['download_time_date'] = time();
			$config                          = ['upload_path'   => 'uploads/products/files/',
												'allowed_types' => 'pdf|docx|doc'];
			$file                            = file_upload_admin('product_file', $config);
			$file_data['product_file']       = $file['file_name'];
			$file_insert                     = $this->common_model->insert('product_downloads', $file_data);
			if ($file_insert) {
				set_message_admin('Product file added successfully', 'success');
				redirect('admin/product/download_files/' . $product_id);
			} else {
				set_message_admin(config_item('admin_error_message'), 'success');
				redirect('admin/product/download_files/' . $product_id);
			}
		}
	}

	/**
	 * @return bool
	 */
	function validate_file()
	{
		$file_title          = $this->input->post('file_title');
		$where['file_title'] = $file_title;
		$result              = $this->common_model->get('product_downloads', $where);
		if ($result->num_rows() > 0) {
			$this->form_validation->set_message('validate_file', 'File title you enter is already exist');

			return false;
		}
		$valid_ext = ['pdf', 'doc', 'docx'];
		if (!empty($_FILES['product_file']['name'])) {
			$ext = strtolower(pathinfo($_FILES['product_file']['name'], PATHINFO_EXTENSION));
			if (!in_array($ext, $valid_ext)) {
				$this->form_validation->set_message('validate_file', 'Please select a file with valid extension');

				return false;
			}
		} else {
			$this->form_validation->set_message('validate_product', 'Product file is required');

			return false;
		}

		return true;
	}

	/**
	 * @param $product_id
	 * @param $file_id
	 */
	function edit_file($product_id, $file_id)
	{
		$this->form_validation->set_rules('file_title', 'file title', 'trim|required');
		$this->form_validation->set_rules('product_file', 'product file', 'trim|callback_validate_file_edit');
		if ($this->form_validation->run() == false) {
			$data['product_file'] = $this->product_model->get_download_files($product_id, $file_id);
			$data['product_id']   = $product_id;
			$data['file_id']      = $file_id;
			$data['active']       = 'products';
			$data['content']      = $this->load->view('admin/products/file_edit', $data, true);
			$this->load->view('admin/templates/template', $data);
		} else {
			$file_data['product_id'] = $product_id;
			$file_data['file_title'] = $this->input->post('file_title');;
			if (!empty($_FILES['product_file']['name'])) {
				$path                      = 'uploads/products/files/';
				$config                    = ['upload_path'   => $path,
											  'allowed_types' => 'pdf|docx|doc'];
				$file                      = file_upload_admin('product_file', $config);
				$file_data['product_file'] = $file['file_name'];
				$old_file[]                = $path . $this->input->post('old_file');
				unlink_files($old_file);
			}
			$file_insert = $this->common_model->update('product_downloads', $file_data, ['id' => $file_id]);
			if ($file_insert) {
				set_message_admin('Product file updated successfully', 'success');
				redirect('admin/product/download_files/' . $product_id);
			} else {
				set_message_admin(config_item('admin_error_message'), 'success');
				redirect('admin/product/download_files/' . $product_id);
			}
		}
	}

	/**
	 * @return bool
	 */
	function validate_file_edit()
	{
		$file_title          = $this->input->post('file_title');
		$file_id             = $this->input->post('file_id');
		$where['id!=']       = $file_id;
		$where['file_title'] = $file_title;
		$result              = $this->common_model->get('product_downloads', $where);
		if ($result->num_rows() > 0) {
			$this->form_validation->set_message('validate_file_edit', 'File title you enter is already exist');

			return false;
		}
		$valid_ext = ['pdf', 'doc', 'docx'];
		if (!empty($_FILES['product_file']['name'])) {
			$ext = strtolower(pathinfo($_FILES['product_file']['name'], PATHINFO_EXTENSION));
			if (!in_array($ext, $valid_ext)) {
				$this->form_validation->set_message('validate_file_edit', 'Please select a file with valid extension');

				return false;
			}
		}

		return true;
	}

	/**
	 * @param $id
	 * @param $product_id
	 */
	function delete_file($id, $product_id)
	{
		if (is_numeric($id)) {
			$where['id'] = $id;
			$image_data  = $this->common_model->get('product_downloads', $where);
			$image_data  = $image_data->row();
			$file_name   = $image_data->product_file;
			$where['id'] = $id;
			$this->common_model->delete('product_downloads', $where);
			$old_file[] = 'uploads/products/files/' . ($file_name);
			unlink_files($old_file);
			set_message_admin('Product File deleted successfully', 'success');
		}
		redirect('admin/product/download_files/' . $product_id);
	}

	function mark_latest_product($product_id, $mark_status)
	{
		if ($mark_status == 1) {
			$max_number = $this->product_model->get_max_product_mark_number()->row()->max_number;
			$max_number += 1;
			$count = $this->product_model->latest_products_count()->row()->total_count;
			if ($count < 8) {
				$this->common_model->update('product', ['product_mark_number' => $max_number], ['id' => $product_id]);
				set_message_admin('Product marked as latest successfully', 'success');
			} else {
				set_message_admin('Cannot mark more than 8 products as latest', 'danger');
			}
		} else {
			$this->common_model->update('product', ['product_mark_number' => $mark_status], ['id' => $product_id]);
			set_message_admin('Product unmarked successfully', 'success');
		}
		redirect('admin/product');
	}

	function mark_new_arrival($product_id, $mark_status)
	{
		$dir = FCPATH . 'uploads/products/new-arrival';
		array_map('unlink', glob($dir . "/*"));
		if ($mark_status == 1) {
			$this->common_model->update('product', ['product_new_arrival' => 0], ['product_new_arrival' => $mark_status]);
			$this->common_model->update('product', ['product_new_arrival' => $mark_status], ['id' => $product_id]);
			$image = $this->common_model->get('product_images', ['product_id'  => $product_id,
																 'is_featured' => 1], 'product_image')->row_array();
			$data  = ['source_path' => FCPATH . 'uploads/products/original/' . $image['product_image'],
					  'target_path' => 'uploads/products/new-arrival/' . $image['product_image'],
					  'width'       => $this->new_arrival_width,
					  'height'      => $this->new_arrival_height];
			resize_image($data);
			set_message_admin('Product marked as new arrival successfully', 'success');
		} else {
			$this->common_model->update('product', ['product_new_arrival' => $mark_status], ['id' => $product_id]);
			set_message_admin('Product unmarked successfully', 'success');
		}
		redirect('admin/product');
	}

	function latest_products()
	{
		$data['latest_products'] = $this->product_model->get_latest_products();
		$data['active']          = 'latest_products';
		$data['content']         = $this->load->view('admin/products/latest_products', $data, true);
		$this->load->view('admin/templates/template', $data);
	}

	function shift_products($id = '', $number = '', $shift = '')
	{
		$result       = $this->product_model->get_next_shift_number($number, $shift)->row();
		$shift_id     = $result->id;
		$shift_number = $result->product_mark_number;
		$this->common_model->update('product', ['product_mark_number' => $shift_number], ['id' => $id]);
		$this->common_model->update('product', ['product_mark_number' => $number], ['id' => $shift_id]);
		set_message_admin('Products Swapped Successfully', 'success');
		redirect('admin/product/latest_products');
	}
}