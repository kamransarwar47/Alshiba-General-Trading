<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Class Brands
	 */
	class Brands extends CI_Controller{
		private $width         = 275;
		private $height        = 150;
		private $header_width  = 1170;
		private $header_height = 350;
		private $admin_width   = 150;
		private $admin_height  = 150;

		/**
		 * Brands constructor.
		 */
		function __construct(){
			parent::__construct();
			$this->load->model('common_model');
		}

		function index(){
			$where['brand_status!='] = '2';
			$data['brands']          = $this->common_model->get('brand', $where);
			$data['active']          = 'brands';
			$data['content']         = $this->load->view('admin/brands/listing', $data, true);
			$this->load->view('admin/templates/template', $data);
		}

		function add(){
			$this->form_validation->set_rules('name', 'Brand Name', 'trim|required');
			$this->form_validation->set_rules('description', 'description', 'trim|required|callback_validate_brand');
			if($this->form_validation->run() == false){
				$data['active']  = 'brands';
				$data['content'] = $this->load->view('admin/brands/add', $data, true);
				$this->load->view('admin/templates/template', $data);
			}else{
				$brand['brand_name']        = $this->input->post('name');
				$brand['brand_url_name']    = safe_url($brand['brand_name']);
				$brand['brand_description'] = $this->input->post('description');
				#===============================brand image upload====================
				$config               = ['upload_path'   => 'uploads/brands/original',
										 'allowed_types' => 'gif|jpg|png'];
				$file                 = file_upload_admin('image', $config);
				$brand['brand_image'] = $file['file_name'];
				$data                 = ['source_path' => $file['full_path'],
										 'target_path' => 'uploads/brands/' . $file['file_name'],
										 'width'       => $this->width,
										 'height'      => $this->height];
				resize_image($data);
				$data = ['source_path' => $file['full_path'],
						 'target_path' => 'uploads/brands/admin/admin_' . $file['file_name'],
						 'width'       => $this->admin_width,
						 'height'      => $this->admin_height];
				resize_image($data);
				#========================= Header Image upload ========
				$config = ['upload_path'   => 'uploads/brands/original',
						   'allowed_types' => 'gif|jpg|png'];
				$file   = file_upload_admin('header_image', $config);
				$data   = ['source_path' => $file['full_path'],
						   'target_path' => 'uploads/brands/header_image/' . $file['file_name'],
						   'width'       => $this->header_width,
						   'height'      => $this->header_height];
				resize_image($data);
				$data = ['source_path' => $file['full_path'],
						 'target_path' => 'uploads/brands/admin/admin_' . $file['file_name'],
						 'width'       => $this->admin_width,
						 'height'      => $this->admin_height];
				resize_image($data);
				$brand['brand_header_image'] = $file['file_name'];
				$brand['brand_time_date']    = time();
				$this->common_model->insert('brand', $brand);
				set_message_admin('Brand add successfully', 'success');
				redirect('admin/brands');
			}
		}

		/**
		 * @return bool
		 */
		function validate_brand(){
			$brand_name              = $this->input->post('name');
			$safe_name               = safe_url($brand_name);
			$where['brand_url_name'] = $safe_name;
			$result                  = $this->common_model->get('brand', $where);
			if($result->num_rows() > 0){
				$this->form_validation->set_message('validate_brand', 'Brand name you enter is already exist');
				return false;
			}
			$valid_ext = ['jpg', 'jpeg', 'png'];
			if(!empty($_FILES['image']['name'])){
				$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, $valid_ext)){
					$this->form_validation->set_message('validate_brand', 'Please select a valid image for brand image');
					return false;
				}
			}else{
				$this->form_validation->set_message('validate_brand', 'Please select brand image');
				return false;
			}
			if(!empty($_FILES['header_image']['name'])){
				$ext = strtolower(pathinfo($_FILES['header_image']['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, $valid_ext)){
					$this->form_validation->set_message('validate_brand', 'Please select a valid image for header image');
					return false;
				}
			}else{
				$this->form_validation->set_message('validate_brand', 'Please select header image');
				return false;
			}
			return true;
		}

		/**
		 * @param $id
		 */
		function edit($id){
			$this->form_validation->set_rules('name', 'Brand Name', 'trim|required');
			$this->form_validation->set_rules('description', 'description', 'trim|required|callback_validate_brand_edit');
			if($this->form_validation->run() == false){
				$where           = ['id' => $id];
				$data['brand']   = $this->common_model->get('brand', $where);
				$data['active']  = 'brands';
				$data['content'] = $this->load->view('admin/brands/edit', $data, true);
				$this->load->view('admin/templates/template', $data);
			}else{
				$brand['brand_name']        = $this->input->post('name');
				$brand['brand_url_name']    = safe_url($brand['brand_name']);
				$brand['brand_description'] = $this->input->post('description');
				$old_file                   = [];
				#===============================brand image upload====================
				if(!empty($_FILES['image']['name'])){
					$config = ['upload_path'   => 'uploads/brands/original',
							   'allowed_types' => 'gif|jpg|png'];
					$file   = file_upload_admin('image', $config);
					$data   = ['source_path' => $file['full_path'],
							   'target_path' => 'uploads/brands/' . $file['file_name'],
							   'width'       => $this->width,
							   'height'      => $this->height];
					resize_image($data);
					$data = ['source_path' => $file['full_path'],
							 'target_path' => 'uploads/brands/admin/admin_' . $file['file_name'],
							 'width'       => $this->admin_width,
							 'height'      => $this->admin_height];
					resize_image($data);
					$brand['brand_image'] = $file['file_name'];
					$old_file[]           = 'uploads/brands/original/' . $this->input->post('old_image');
					$old_file[]           = 'uploads/brands/' . $this->input->post('old_image');
					$old_file[]           = 'uploads/brands/admin/admin_' . $this->input->post('old_image');
				}
				#========================= Header Image upload ========
				if(!empty($_FILES['header_image']['name'])){
					$config = ['upload_path'   => 'uploads/brands/original',
							   'allowed_types' => 'gif|jpg|png'];
					$file   = file_upload_admin('header_image', $config);
					$data   = ['source_path' => $file['full_path'],
							   'target_path' => 'uploads/brands/header_image/' . $file['file_name'],
							   'width'       => $this->header_width,
							   'height'      => $this->header_height];
					resize_image($data);
					$data = ['source_path' => $file['full_path'],
							 'target_path' => 'uploads/brands/admin/admin_' . $file['file_name'],
							 'width'       => $this->admin_width,
							 'height'      => $this->admin_width];
					resize_image($data);
					$brand['brand_header_image'] = $file['file_name'];
					$old_file[]                  = 'uploads/brands/original/' . $this->input->post('old_header_image');
					$old_file[]                  = 'uploads/brands/header_image/' . $this->input->post('old_header_image');
					$old_file[]                  = 'uploads/brands/admin/admin_' . $this->input->post('old_header_image');
				}
				unlink_files($old_file);
				$where = ['id' => $id];
				$this->common_model->update('brand', $brand, $where);
				set_message_admin('Brand add successfully', 'success');
				redirect('admin/brands');
			}
		}

		/**
		 * @return bool
		 */
		function validate_brand_edit(){
			$brand_name              = $this->input->post('name');
			$id                      = $this->input->post('id');
			$safe_name               = safe_url($brand_name);
			$where['brand_url_name'] = $safe_name;
			$where['id!=']           = $id;
			$result                  = $this->common_model->get('brand', $where);
			if($result->num_rows() > 0){
				$this->form_validation->set_message('validate_brand_edit', 'Brand name you enter is already exist');
				return false;
			}
			$valid_ext = ['jpg', 'jpeg', 'png'];
			if(!empty($_FILES['image']['name'])){
				$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, $valid_ext)){
					$this->form_validation->set_message('validate_brand_edit', 'Please select a valid image for brand image');
					return false;
				}
			}
			if(!empty($_FILES['header_image']['name'])){
				$ext = strtolower(pathinfo($_FILES['header_image']['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, $valid_ext)){
					$this->form_validation->set_message('validate_brand_edit', 'Please select a valid image for header image');
					return false;
				}
			}
			return true;
		}

		/**
		 * @param $id
		 */
		function delete($id){
			if(is_numeric($id)){
				$update['brand_status'] = 2;
				$where['id']            = $id;
				$this->common_model->update('brand', $update, $where);
				set_message_admin('Brand deleted successfully', 'success');
			}
			redirect('admin/brands');
		}

		/**
		 * @param $id
		 * @param $status
		 */
		function change_status($id, $status){
			if(is_numeric($id) && is_numeric($status)){
				switch($status){
					case (1):
						$update['brand_status'] = 1;
						break;
					default:
						$update['brand_status'] = 0;
						break;
				}
				$where['id'] = $id;
				$this->common_model->update('brand', $update, $where);
				set_message_admin('Brand Status changed successfully', 'success');
			}
			redirect('admin/brands');
		}
	}