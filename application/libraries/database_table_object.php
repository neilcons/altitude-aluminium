<?php

class Database_Table_Object
{
	protected $_table_name = NULL;
	protected $_id = NULL;
	protected $_data = array();
	protected $_deleted = FALSE;
	protected $_id_array = array();

	public function set_id_array($key, $val)
	{
		$this->_id_array[$key] = $val;
	}

	public function is_deleted()
	{
		return $this->_deleted;
	}

	public function delete($set_to_false_to_undelete = TRUE)
	{
		$this->_deleted = $set_to_false_to_undelete;
	}

	public function set_defaults()
	{
		return FALSE;
	}

	public function __construct()
	{
		if(is_null($this->_table_name)){
			throw new Exception("Must set table name", 1);
		}

		$this->set_defaults();
	}

	public function load($id, $colname = 'id', $extra_where = array())
	{
		$CI =& get_instance();
//		$CI->db->cache_on();

		$where = array_merge($extra_where, array($colname=>$id));
	
		$row = $CI->db->get_where($this->_table_name, $where);

		if($row->num_rows() !== 1){
			return;
			throw new Exception("Not Found :: Table [{$this->_table_name}], Col [{$colname}], Value [{$id}]" . var_export($extra_where, TRUE), 1);
		}

		$this->_data = $row->row_array();
		unset($this->_data['id']);
		$this->_id = $id;
//		$CI->db->cache_off();
	}

	public function _save($table_name, & $id)
	{
		$CI =& get_instance();
		$CI->load->helper('array');

		if($this->is_deleted()){
			return $CI->db->delete($table_name, array('id'=>$id));
		}

		$data = only_elements($CI->db->list_fields($table_name), $this->_data);

		if(is_null($id)){
			$CI->db->insert($table_name, $data);
			$id = $CI->db->insert_id();
		} else {
			$CI->db->update($table_name, $data, array('id'=>$id));
 		}
	}


	public function save($table_name = NULL)
	{
		if(is_null($table_name)){
			$this->_save($this->_table_name, $this->_id);
		} else {
			if(empty($this->_id_array[$table_name])){
				$this->_id_array[$table_name] = NULL;
			}

			$this->_save($table_name, $this->_id_array[$table_name]);
		}

	}

	public function update_from_array($array)
	{
		if(is_array($array)){
			foreach($array as $key=>$value){
				if($key === 'id'){
					continue;
				}
				$this->$key = $value;
			}
		}
	}

	public function __set($key, $value)
	{
		if($key === 'id'){
			return $this->_id = $value;
		}

		return $this->_data[$key] = $value;
	}

	public function __get($key)
	{
		if($key === 'id'){
			return is_null($this->_id) ? FALSE : $this->_id;
		}

		if(array_key_exists($key, $this->_data)){
			return $this->_data[$key];
		}

		return FALSE;
	}
}