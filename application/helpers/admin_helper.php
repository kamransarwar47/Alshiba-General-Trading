<?php if(!defined('BASEPATH'))
	exit('No direct script access allowed');
	/**
	 * @param $message
	 * @param $status
	 */
	function set_message_admin($message, $status){
		$CI      =	&get_instance();
		$message = ['message' => $message,
					'status'  => $status];
		$message = $CI->load->view('admin/includes/message', $message, true);
		$CI->session->set_flashdata('message', $message);
	}

	/**
	 * @param $name
	 * @return string
	 */
	function safe_url($name){
		return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($name, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}

	/**
	 * @param $field_name
	 * @param $config
	 * @return mixed
	 */
	function file_upload_admin($field_name, $config){
		$CI =	&get_instance();
		$CI->load->library('upload', $config);
		if(!$CI->upload->do_upload($field_name)){
			$data = $CI->upload->display_errors();
		}else{
			$data = $CI->upload->data();
		}
		return $data;
	}

	/**
	 * @param $data
	 * @return string
	 */
	function resize_image($data){
		$CI =	&get_instance();
		$CI->load->library('image_lib');
		$config = ['image_library'  => 'gd2',
				   'source_image'   => $data['source_path'],
				   'new_image'      => $data['target_path'],
				   'maintain_ratio' => false,
				   'width'          => $data['width'],
				   'height'         => $data['height'],
                                   'quality'        => 60];
		$CI->image_lib->initialize($config);
		if(!$CI->image_lib->resize()){
			return $CI->image_lib->display_errors();
		}
		$CI->image_lib->clear();
		return '1';
	}

	/**
	 * @param $status
	 * @return string
	 */
	function get_status($status){
		if($status == 1){
			$return['text']   = 'Active';
			$return['status'] = 0;
		}else{
			$return['text']   = 'Inactive';
			$return['status'] = 1;
		}
		return $return;
	}

	/**
	 * @param array $unlink
	 * @return bool
	 */
	function unlink_files($unlink = []){
		if(count($unlink) > 0){
			foreach($unlink as $file){
				@unlink($file);
			}
		}
		return true;
	}

	/**
	 * @param $product_id
	 * @return bool
	 */
	function set_feature_image($product_id){
		$CI          =	&get_instance();
		$is_featured = $CI->db->select('id')
							  ->where(['product_id' => $product_id, 'is_featured' => '1'])
							  ->get('product_images')
							  ->num_rows();
		if($is_featured < 1){
			$CI->db->select('id');
			$CI->db->where('product_id', $product_id);
			$CI->db->order_by('id', 'asc');
			$CI->db->limit(1);
			$row = $CI->db->get('product_images');
			if(count($row->num_rows()) > 0){
				$update['is_featured'] = 1;
				$where['id']           = $row->row()->id;
				$CI->db->update('product_images', $update, $where);
			}
		}
		return true;
	}

	function is_login(){
//		$CI =	&get_instance();
//		$id = $CI->session->userdata('AlshibaAdminLoginId');
//		if(empty($id)){
//			redirect('admin');
//		}
        return true;
	}