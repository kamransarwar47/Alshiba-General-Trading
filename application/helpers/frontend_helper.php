<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    function get_brands()
    {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->where('brand_status', 1);
        $CI->db->order_by('sorting', 'asc');

        return $CI->db->get('brand');
    }

    function get_categories()
    {
        $CI = &get_instance();

        return $CI->common_model->get('category', ['category_status' => 1]);
    }

    function get_id_by_url_name($table = '', $where = '')
    {
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->where($where);
        $result = $CI->db->get($table)
            ->result_array();
        if (count($result) > 0) {
            return $result[0]['id'];
        } else {
            return 0;
        }
    }

    function get_total_cart_items($user_id = '')
    {
        $CI     = &get_instance();
        $result = $CI->common_model->get('cart', ['user_id' => $user_id], 'id')
            ->num_rows();
        if ($result > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    function get_footer_data()
    {
        $CI = &get_instance();
        $CI->db->select(['brand_name', 'brand_url_name']);
        $CI->db->where('brand_status', 1);
        $CI->db->order_by('sorting', 'asc');
        $CI->db->limit(10);
        $return['brands'] = $CI->db->get('brand');
        $CI->db->select(['category_name', 'category_url_name']);
        $CI->db->where('category_status', 1);
        $CI->db->limit(10);
        $return['products'] = $CI->db->get('category');
        $CI->db->select(['footer_text', 'header_text']);
        $CI->db->limit(10);
        $return['contact'] = $CI->db->get('admin');

        return $return;
    }