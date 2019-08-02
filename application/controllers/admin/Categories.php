<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Class Categories
	 */
	class Categories extends CI_Controller{
		/**
		 * Categories constructor.
		 */
		private $width        = 275;
		private $height       = 90;
		private $admin_width  = 150;
		private $admin_height = 150;

		/**
		 * Categories constructor.
		 */
		function __construct(){
			parent::__construct();
			is_login();
			$this->load->model('common_model');
		}

		function index(){
			$where['category_status!='] = '2';
			$data['categories']         = $this->common_model->get('category', $where);
			$data['active']             = 'categories';
			$data['content']            = $this->load->view('admin/categories/listing', $data, true);
			$this->load->view('admin/templates/template', $data);
		}

		function add(){
			$this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
			$this->form_validation->set_rules('category_description', 'Category description', 'trim|required|callback_validate_category');
			if($this->form_validation->run() == false){
				$data['active']  = 'categories';
				$data['content'] = $this->load->view('admin/categories/add', $data, true);
				$this->load->view('admin/templates/template', $data);
			}else{
				$category['category_name']        = $this->input->post('category_name');
				$category['category_url_name']    = safe_url($category['category_name']);
				$category['category_description'] = $this->input->post('category_description');
				#===============================category image upload====================
				$config = ['upload_path'   => 'uploads/categories/original',
						   'allowed_types' => 'gif|jpg|png'];
				$file   = file_upload_admin('image', $config);
				$data   = ['source_path' => $file['full_path'],
						   'target_path' => 'uploads/categories/' . $file['file_name'],
						   'width'       => $this->width,
						   'height'      => $this->height];
				resize_image($data);
				$data = ['source_path' => $file['full_path'],
						 'target_path' => 'uploads/categories/admin/admin_' . $file['file_name'],
						 'width'       => $this->admin_width,
						 'height'      => $this->admin_height];
				resize_image($data);
				$category['category_image']     = $file['file_name'];
				$category['category_time_date'] = time();
				$this->common_model->insert('category', $category);
				set_message_admin('category added successfully', 'success');
				redirect('admin/categories');
			}
		}

		/**
		 * @return bool
		 */
		function validate_category(){
			$category_name              = $this->input->post('category_name');
			$safe_name                  = safe_url($category_name);
			$where['category_url_name'] = $safe_name;
			$result                     = $this->common_model->get('category', $where);
			if($result->num_rows() > 0){
				$this->form_validation->set_message('validate_category', 'category name you enter is already exist');
				return false;
			}
			$valid_ext = ['jpg', 'jpeg', 'png'];
			if(!empty($_FILES['image']['name'])){
				$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, $valid_ext)){
					$this->form_validation->set_message('validate_category', 'Please select a valid image for category image');
					return false;
				}
			}else{
				$this->form_validation->set_message('validate_category', 'Please select category image');
				return false;
			}
			return true;
		}

		/**
		 * @param $id
		 */
		function edit($id){
			$this->form_validation->set_rules('category_name', 'Category name', 'trim|required');
			$this->form_validation->set_rules('category_description', 'description', 'trim|required|callback_validate_category_edit');
			if($this->form_validation->run() == false){
				$where            = ['id' => $id];
				$data['category'] = $this->common_model->get('category', $where);
				$data['active']   = 'categories';
				$data['content']  = $this->load->view('admin/categories/edit', $data, true);
				$this->load->view('admin/templates/template', $data);
			}else{
				$category['category_name']        = $this->input->post('category_name');
				$category['category_url_name']    = safe_url($category['category_name']);
				$category['category_description'] = $this->input->post('category_description');
				$old_file                         = [];
				#===============================validate image upload====================
				if(!empty($_FILES['image']['name'])){
					$config = ['upload_path'   => 'uploads/categories/original',
							   'allowed_types' => 'gif|jpg|png'];
					$file   = file_upload_admin('image', $config);
					$data   = ['source_path' => $file['full_path'],
							   'target_path' => 'uploads/categories/' . $file['file_name'],
							   'width'       => $this->width,
							   'height'      => $this->height];
					resize_image($data);
					$data = ['source_path' => $file['full_path'],
							 'target_path' => 'uploads/categories/admin/admin_' . $file['file_name'],
							 'width'       => $this->admin_width,
							 'height'      => $this->admin_height];
					resize_image($data);
					$category['category_image'] = $file['file_name'];
					$old_file[]                 = 'uploads/categories/original/' . $this->input->post('old_image');
					$old_file[]                 = 'uploads/categories/' . $this->input->post('old_image');
					$old_file[]                 = 'uploads/categories/admin/admin_' . $this->input->post('old_image');
				}
				#========================= Header Image upload ========
				unlink_files($old_file);
				$where = ['id' => $id];
				$this->common_model->update('category', $category, $where);
				set_message_admin('category added successfully', 'success');
				redirect('admin/categories');
			}
		}

		/**
		 * @return bool
		 */
		function validate_category_edit(){
			$category_name              = $this->input->post('category_name');
			$id                         = $this->input->post('id');
			$safe_name                  = safe_url($category_name);
			$where['category_url_name'] = $safe_name;
			$where['id!=']              = $id;
			$result                     = $this->common_model->get('category', $where);
			if($result->num_rows() > 0){
				$this->form_validation->set_message('validate_category_edit', 'category name you enter is already exist');
				return false;
			}
			$valid_ext = ['jpg', 'jpeg', 'png'];
			if(!empty($_FILES['image']['name'])){
				$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
				if(!in_array($ext, $valid_ext)){
					$this->form_validation->set_message('validate_category_edit', 'Please select a valid image for category image');
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
				$update['category_status'] = 2;
				$where['id']               = $id;
				$this->common_model->update('category', $update, $where);
				set_message_admin('category deleted successfully', 'success');
			}
			redirect('admin/categories');
		}

		/**
		 * @param $id
		 * @param $status
		 */
		function change_status($id, $status){
			if(is_numeric($id) && is_numeric($status)){
				switch($status){
					case (1):
						$update['category_status'] = 1;
						break;
					default:
						$update['category_status'] = 0;
						break;
				}
				$where['id'] = $id;
				$this->common_model->update('category', $update, $where);
				set_message_admin('category Status changed successfully', 'success');
			}
			redirect('admin/categories');
		}
	}