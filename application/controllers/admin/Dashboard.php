<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Class Dashboard
	 */
	class Dashboard extends CI_Controller{
		/**
		 * Dashboard constructor.
		 */
		function __construct(){
			parent::__construct();
			$this->load->model('common_model');
		}

		function index(){
//			$data['content'] = $this->load->view('admin/dashboard/dashboard', '', true);
//			$this->load->view('admin/templates/template', $data);
            redirect('admin/product');
		}
	}