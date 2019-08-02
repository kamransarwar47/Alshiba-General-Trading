<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * Class Login
	 */
	class Login extends CI_Controller{
		/**
		 * Login constructor.
		 */
		function __construct(){
			parent::__construct();
		}

		function index(){
			$this->form_validation->set_rules('username', 'User name', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_ValidateLogin');
			if($this->form_validation->run() == false){
				$data['content'] = $this->load->view('admin/login/login', '', true);
				$this->load->view('admin/templates/login_template', $data);
			}else{
				redirect('admin/product');
			}
		}

		/**
		 * @return bool
		 */
		function ValidateLogin(){
			if($this->input->post('password') != ''){
				$this->load->library('encrypt');
				$username                 = $this->input->post('username');
				$password                 = base64_encode(base64_encode($this->input->post('password')));
				$where['admin_user_name'] = $username;
				$where['admin_password']  = $password;
				$result                   = $this->common_model->get('admin', $where);
				if($result->num_rows() > 0){
					$admin_data = $result->row();
					$this->session->set_userdata('AlshibaAdminLoginId', $admin_data->id);
					$this->session->set_userdata('AlshibaAdminUserName', $username);
					$this->session->set_userdata('AlshibaAdminEmail', $admin_data->admin_email);
					return true;
				}else{
					$this->form_validation->set_message('ValidateLogin', 'User name or password is invalid.');
					return false;
				}
			}
			return true;
		}

		function forgot_password(){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_validate_email');
			if($this->form_validation->run() == false){
				$data['content'] = $this->load->view('admin/login/forgot_password', '', true);
				$this->load->view('admin/templates/login_template', $data);
			}else{
				redirect('users');
			}
		}

		/**
		 * @param $id
		 * @param $token
		 */
		function reset_password($id, $token){
			$where['id']    = $id;
			$where['token'] = $token;
			$result         = $this->common_model->get('admin', $where);
			if($result->num_rows() <= 0){
				redirect('');
			}
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
			if($this->form_validation->run() == false){
				$data['content'] = $this->load->view('admin/login/reset_password', '', true);
				$this->load->view('admin/templates/login_template', $data);
			}else{
				$update['admin_password'] = base64_encode(base64_encode($this->input->post('password')));
				$update['token']          = '';
				$condition                = ['id' => $id];
				$update                   = $this->common_model->update('admin', $update, $condition);
				if($update){
					set_message_admin('Password reset successfully', 'success');
				}else{
					set_message_admin(config_item('admin_error_message'), 'danger');
				}
				redirect('admin');
			}
		}

		/**
		 * @return bool
		 */
		function validate_email(){
			$email     = $this->input->post('email');
			$condition = ['admin_email' => $email];
			$result    = $this->common_model->get('admin', $condition);
			if($result->num_rows() > 0){
				$UserInfo        = $result->row();
				$token           = bin2hex(openssl_random_pseudo_bytes(2)) . time() . md5(md5($UserInfo->id));
				$update['token'] = $token;
				$condition       = ['id' => $UserInfo->id];
				$update          = $this->common_model->update('admin', $update, $condition);
				if(!$update){
					set_message_admin(config_item('admin_error_message'), 'danger');
				}
				//---------------email to user--------------
				$EmailTemp             = $this->load->view('admin/emails/forgot_password', '', true);
				$message               = $EmailTemp;
				$site_url              = site_url();
				$link                  = $site_url . 'admin/login/reset_password/' . ($UserInfo->id) . '/' . $token;
				$link                  = '<a href="' . $link . '">Reset Password</a>';
				$site_name             = config_item('site_name');
				$find                  = ["{site_url}", "{site_name}", "{link}"];
				$replace               = [$site_url, $site_name, $link];
				$message               = str_replace($find, $replace, $message);
				$email_data['subject'] = config_item('site_name') . ' ~ Forgot Password';
				$email_data['form']    = config_item('from_email');
				$email_data['to']      = $UserInfo->admin_email;
				$email_data['message'] = $message;
				$send                  = _send_email($email_data);
				if($send){
					set_message_admin('An Email has been sent to the email address you enter', 'success');
				}else{
					set_message_admin('There is an error in email sending, Please try again latter', 'danger');
				}
				redirect('admin/forgot_password');
			}else{
				$this->form_validation->set_message('validate_email', 'Email you entered is not in our record');
				return false;
			}
			return true;
		}

		function profile(){
			is_login();
			$this->form_validation->set_rules('admin_name', 'Name', 'trim|required');
			$this->form_validation->set_rules('admin_user_name', 'User name', 'trim|required');
			$this->form_validation->set_rules('admin_email', 'Email', 'trim|required');
			$this->form_validation->set_rules('phone', 'Email', 'trim|required');
			$admin_id = $this->session->userdata('AlshibaAdminLoginId');
			if($this->form_validation->run() == false){
				$data['admin_data'] = $this->common_model->get('admin', ["id" => $admin_id]);
				$data['content']    = $this->load->view('admin/login/profile', $data, true);
				$this->load->view('admin/templates/template', $data);
			}else{
				$update['admin_name']      = $this->input->post('admin_name');
				$update['admin_user_name'] = $this->input->post('admin_user_name');
				$update['admin_email']     = $this->input->post('admin_email');
				$update['phone']           = $this->input->post('phone');
				$update['footer_text']     = $this->input->post('footer_text');
				$update['header_text']     = $this->input->post('header_text');
				$password                  = $this->input->post ('admin_password');

            if ($password != '')
            {
                $update['admin_password'] = base64_encode (base64_encode ($this->input->post ('admin_password')));
            }
				$condition = ['id' => $admin_id];
				$update    = $this->common_model->update('admin', $update, $condition);
				if($update){
					set_message_admin('Profile Updated successfully', 'success');
				}else{
					set_message_admin(config_item('admin_error_message'), 'danger');
				}
				redirect('admin/login/profile');
			}
		}

		function logout(){
			$this->session->unset_userdata('AlshibaAdminLoginId');
			$this->session->unset_userdata('AlshibaAdminUserName');
			$this->session->unset_userdata('AlshibaAdminEmail');
			redirect('admin');
		}
	}