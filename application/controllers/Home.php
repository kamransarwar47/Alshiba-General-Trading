<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index()
	{
		$data['title']           = 'Al Shiba General Trading';
		$data['active_tab']      = 'home';
		$data['latest_products'] = $this->home_model->get_latest_products();
		$data['new_arrival']     = $this->home_model->get_new_arrival();
		//$data['banner_images']   = $this->common_model->get('slider', ['slider_status' => 1], 'slider_image')->result_array();
		$data['banner_images'] = $this->common_model->get_slider('slider', ['slider_status' => 1], 'slider_image')->result_array();
		$data['content']       = $this->load->view('homepage', $data, true);
		$this->load->view('templates/template', $data);
	}

	public function contact()
	{
		$this->form_validation->set_rules('full_name', 'Full Name', 'required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
		$this->form_validation->set_rules('message', 'Message', 'required');
		if ($this->form_validation->run() == false) {
			$data['title']           = 'Al Shiba General Trading';
			$data['active_tab']      = 'contact';
			$data['latest_products'] = $this->home_model->get_latest_products();
			$data['content']         = $this->load->view('contact', $data, true);
			$this->load->view('templates/template', $data);
		} else {
			$this->send_contact_form_email();
		}
	}

	public function about()
	{
		$data['title']           = 'Al Shiba General Trading';
		$data['active_tab']      = 'about';
		$data['latest_products'] = $this->home_model->get_latest_products();
		$data['content']         = $this->load->view('about', $data, true);
		$this->load->view('templates/template', $data);
	}

	public function send_contact_form_email()
	{
		$this->load->library('email');
		$admin_email = $this->common_model->get('admin', ['id' => 1], 'admin_email')->result_array()[0]['admin_email'];
		//$admin_email           = 'xamiakhalil99@gmail.com';
		$name                  = $this->input->post('full_name');
		$email                 = $this->input->post('email_address');
		$phone                 = $this->input->post('phone_number');
		$message               = $this->input->post('message');
		$EmailTemp             = $this->load->view('emails/contact_form', '', true);
		$email_message         = $EmailTemp;
		$find                  = ["{salutation}", "{name}", "{email}", "{phone}", "{message}"];
		$replace               = ['Dear Administrator', $name, $email, $phone, $message];
		$email_message         = str_replace($find, $replace, $email_message);
		$email_data['subject'] = config_item('site_name') . ' ~ New Contact Message';
		$email_data['form']    = config_item('from_email');
		$email_data['to']      = $admin_email;
		$data['message']       = $email_message;
		$email_template        = $this->load->view('templates/email_template', $data, true);
		$email_data['message'] = $email_template;
		$contact_email_send    = _send_email($email_data);
		if (isset($_POST['quick_enquiry']) && $_POST['quick_enquiry'] == 1) {
			if ($contact_email_send) {
				$data['msg'] = 'success';
			} else {
				$data['msg'] = 'error';
			}
			echo json_encode($data);
		} else {
			if ($contact_email_send) {
				$this->session->set_flashdata('contact_form_message', '<div class="col-md-12 alert alert-dismissible alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success: </strong>Your message is sent successfully. You will be contacted soon.</div>');
			} else {
				$this->session->set_flashdata('contact_form_message', '<div class="col-md-12 alert alert-dismissible alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error: </strong>There is some error in sending message. Please try again.</div>');
			}
			redirect('contact');
		}
	}
}
