<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
	}

	public function product()
	{
		$data['title']        = 'Search - Al Shiba General Trading';
		$data['active_tab']   = '';
		$input_text           = $this->input->post('search_input_header');
		$data['all_products'] = $this->search_model->get_products_by_search($input_text);
		$data['content']      = $this->load->view('search', $data, true);
		$this->load->view('templates/template', $data);
	}
}
