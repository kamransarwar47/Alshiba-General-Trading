<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Slider
 */
class Slider extends CI_Controller
{
	/**
	 * Slider constructor.
	 */
	private $width        = 1368;
	private $height       = 378;
	private $admin_width  = 200;
	private $admin_height = '';

	function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('common_model');
	}

	function index()
	{
		$where['slider_status!='] = '2';
		$data['slider']           = $this->common_model->get('slider', $where);
		$data['active']           = 'slider';
		$data['content']          = $this->load->view('admin/slider/listing', $data, true);
		$this->load->view('admin/templates/template', $data);
	}

	function add()
	{
		$this->form_validation->set_rules('image', 'Image', 'trim|callback_validate_image');
		if ($this->form_validation->run() == false) {
			$data['active']  = 'slider';
			$data['content'] = $this->load->view('admin/slider/add', $data, true);
			$this->load->view('admin/templates/template', $data);
		} else {
			#===============================Slider image upload============
			$files = $_FILES;
			$cpt   = count($_FILES['image']['name']);
			$time  = time();
			for ($i = 0; $i < $cpt; $i++) {
				if ($i == 0)
					$_FILES['image']['name'] = $files['image']['name'][$i];
				$_FILES['image']['type']     = $files['image']['type'][$i];
				$_FILES['image']['tmp_name'] = $files['image']['tmp_name'][$i];
				$_FILES['image']['error']    = $files['image']['error'][$i];
				$_FILES['image']['size']     = $files['image']['size'][$i];
				$config                      = ['upload_path'   => 'uploads/slider/original',
												'allowed_types' => 'gif|jpg|png'];
				$file                        = file_upload_admin('image', $config);
				$data                        = ['source_path' => $file['full_path'],
												'target_path' => 'uploads/slider/' . $file['file_name'],
												'width'       => $this->width,
												'height'      => $this->height];
				resize_image($data);
				$data = ['source_path' => $file['full_path'],
						 'target_path' => 'uploads/slider/admin/admin_' . $file['file_name'],
						 'width'       => $this->admin_width,
						 'height'      => $this->admin_height];
				resize_image($data);
				$slider[$i]['slider_image']     = $file['file_name'];
				$slider[$i]['slider_time_date'] = $time;
			}
			$this->common_model->insert_batch('slider', $slider);
			set_message_admin('Slider Images add successfully', 'success');
			redirect('admin/slider');
		}
	}

	/**
	 * @return bool
	 */
	function validate_image()
	{
		$valid_ext = ['jpg', 'jpeg', 'png'];
		if (!empty($_FILES['image']['name'])) {
			foreach ($_FILES['image']['name'] as $name) {
				$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
				if (!in_array($ext, $valid_ext)) {
					$this->form_validation->set_message('validate_image', 'Please select a valid image');

					return false;
				}
			}
		} else {
			$this->form_validation->set_message('validate_brand', 'Please select an image');

			return false;
		}

		return true;
	}

	/**
	 * @param $id
	 */
	function delete($id, $file_name)
	{
		if (is_numeric($id)) {
			$update['brand_status'] = 2;
			$where['id']            = $id;
			$this->common_model->delete('slider', $where);
			$old_file[] = 'uploads/slider/original/' . urldecode($file_name);
			$old_file[] = 'uploads/slider/' . urldecode($file_name);
			$old_file[] = 'uploads/slider/admin/admin_' . urldecode($file_name);
			unlink_files($old_file);
			set_message_admin('Slider Image deleted successfully', 'success');
		}
		redirect('admin/slider');
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
					$update['slider_status'] = 1;
					break;
				default:
					$update['slider_status'] = 0;
					break;
			}
			$where['id'] = $id;
			$this->common_model->update('slider', $update, $where);
			set_message_admin('Images Status changed successfully', 'success');
		}
		redirect('admin/slider');
	}
}