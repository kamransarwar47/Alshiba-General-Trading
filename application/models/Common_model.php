<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Class Common_model
 */
class Common_model extends CI_Model
{
	/**
	 * Common_model constructor.
	 */
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * @param        $table_name
	 * @param array $where
	 * @param string $fields
	 * @return mixed
	 */
	function get($table_name, $where = [], $fields = '*')
	{
		$this->db->select($fields);
		if (count($where) > 0) {
			$this->db->where($where);
		}
		$result = $this->db->get($table_name);

		return $result;
	}
 function get_slider($table_name, $where = [], $fields = '*')
	{
		$this->db->select($fields);
		if (count($where) > 0) {
			$this->db->where($where);
		}
                $this->db->order_by('sorting','asc');
		$result = $this->db->get($table_name);

		return $result;
	}
	/**
	 * @param $table_name
	 * @param $data
	 * @param $where
	 * @return mixed
	 */
	function update($table_name, $data, $where)
	{
		$this->db->update($table_name, $data, $where);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param $table_name
	 * @param $data
	 * @return mixed
	 */
	function insert($table_name, $data)
	{
		$this->db->insert($table_name, $data);
		if ($this->db->affected_rows() > 0) {
			return $this->db->insert_id();
		} else {
			return false;
		}
	}

	/**
	 * @param $table_name
	 * @param $where
	 * @return bool
	 */
	function delete($table_name, $where)
	{
		$this->db->where($where);
		$this->db->delete($table_name);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param $table_name
	 * @param $data
	 * @return mixed
	 */
	function insert_batch($table_name, $data)
	{
		$this->db->insert_batch($table_name, $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param $sql
	 * @return mixed
	 */
	function query($sql)
	{
		return $this->db->query($sql);
	}
}