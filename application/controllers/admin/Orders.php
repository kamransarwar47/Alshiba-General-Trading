<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Class Orders
	 */
	class Orders extends CI_Controller{
		/**
		 * Orders constructor.
		 */
		function __construct(){
			parent::__construct();
			is_login();
			$this->load->model('admin/order_model');
		}

		function index(){
			$where['order_status!='] = '2';
			$data['orders']          = $this->common_model->get('orders', $where);
			$data['active']          = 'orders';
			$data['content']         = $this->load->view('admin/orders/listing', $data, true);
			$this->load->view('admin/templates/template', $data);
		}
		function details($order_id){
			$data['order_details']          = $this->order_model->order_detail($order_id);
			$data['active']          = 'orders';
			$data['content']         = $this->load->view('admin/orders/detail', $data, true);
			$this->load->view('admin/templates/template', $data);
		}

		function delete($id){
			if(is_numeric($id)){
				$where['id'] = $id;
				$this->common_model->delete('orders', $where);
				$where['orders_id'] = $id;
				$this->common_model->delete('order_details', $where);
				set_message_admin('Order deleted successfully', 'success');
			}
			redirect('admin/orders');
		}
	}