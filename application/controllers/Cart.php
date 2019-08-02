<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cart_model');
	}

	public function add()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['product_id']     = $this->input->post('prod_id');
			$data['user_id']        = $this->input->post('user_id');
			$data['cart_time_date'] = time();
			if ($this->cart_model->add_cart($data)) {
				$msg['total_item'] = get_total_cart_items($data['user_id']);
				$msg['msg']        = 'success';
			} else {
				$msg['msg'] = 'error';
			}
			echo json_encode($msg);
		}
	}

	public function view()
	{
		$this->form_validation->set_rules('full_name', 'Name', 'required');
		$this->form_validation->set_rules('email_address', 'Email', 'required');
		$this->form_validation->set_rules('phone_number', 'Phone', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if ($this->form_validation->run() == false) {
			$data['title']         = 'Enquiry Cart - Al Shiba General Trading';
			$data['cart_items']    = get_total_cart_items($_COOKIE['user_unique_id']);
			$data['cart_products'] = $this->cart_model->get_all_cart_products($_COOKIE['user_unique_id']);
			$data['content']       = $this->load->view('cart', $data, true);
			$this->load->view('templates/template', $data);
		} else {
			$cart_products            = $this->cart_model->get_cart_products_for_insert($_COOKIE['user_unique_id'])->result_array();
			$data['name']             = $this->input->post('full_name');
			$data['email']            = $this->input->post('email_address');
			$data['phone']            = $this->input->post('phone_number');
			$data['address']          = $this->input->post('address');
			$data['orders_time_date'] = time();
			if (!empty($cart_products)) {
				$result = $this->common_model->insert('orders', $data);
				if ($result) {
					foreach ($cart_products as $key => $row) {
						$cart_products[$key]['orders_id']               = $result;
						$cart_products[$key]['order_details_time_date'] = time();
					}
					$this->common_model->insert_batch('order_details', $cart_products);
					$this->common_model->delete('cart', ['user_id' => $_COOKIE['user_unique_id']]);
					//--------------- email to user -------------- //
					$data['cart_products'] = $cart_products;
					$EmailTemp             = $this->load->view('emails/order_email', $data, true);
					$message               = $EmailTemp;
					$find                  = ["{salutation}", "{name}", "{email}", "{phone}", "{address}"];
					$replace               = ['Dear ' . ucwords($data['name']), $data['name'], $data['email'],
											  $data['phone'],
											  $data['address']];
					$message               = str_replace($find, $replace, $message);
					$email_data['subject'] = config_item('site_name') . ' ~ New Order Placement';
					$email_data['form']    = config_item('from_email');
					$email_data['to']      = $data['email'];
					$data['message']       = $message;
					$email_template        = $this->load->view('templates/email_template', $data, true);
					$email_data['message'] = $email_template;
					$user_email_send       = _send_email($email_data);
					//--------------- email to user -------------- //
					//--------------- email to admin -------------- //
					$admin_email           = $this->common_model->get('admin', ['id' => 1], 'admin_email')->result_array()[0]['admin_email'];
					$find                  = ['Dear ' . ucwords($data['name'])];
					$replace               = ['Dear Administrator'];
					$message               = str_replace($find, $replace, $email_template);
					$email_data['to']      = $admin_email;
					$email_data['message'] = $message;
					$admin_email_send      = _send_email($email_data);
					//--------------- email to admin -------------- //
					$this->session->set_flashdata('error_message', '<div class="col-md-12 alert alert-dismissible alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success: </strong>Your order is placed successfully. You will be contacted soon.</div>');
				}
			} else {
				$this->session->set_flashdata('error_message', '<div class="col-md-12 alert alert-dismissible alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error: </strong>Please add items in the cart to continue</div>');
			}
			redirect('cart/view');
		}
	}

	public function delete()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$cart_id = $this->input->post('cart_id');
			$user_id = $this->input->post('user_id');
			if ($this->common_model->delete('cart', ['id' => $cart_id])) {
				$msg['total_item'] = get_total_cart_items($user_id);
				$msg['msg']        = 'success';
			} else {
				$msg['msg'] = 'error';
			}
			echo json_encode($msg);
		}
	}

	public function add_quantity()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id                       = $this->input->post('cart_id');
			$data['product_quantity'] = $this->input->post('quantity');
			if ($this->common_model->update('cart', $data, ['id' => $id])) {
				$msg['msg'] = 'success';
			} else {
				$msg['msg'] = 'error';
			}
			echo json_encode($msg);
		}
	}
}
