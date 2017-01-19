<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Constants extends CI_Model {

	private $_data = NULL;

	/*
	 * defines the constant records from the database as php constants prefixed with CONST_ based on the application id
	 */
	public function define_constants()
	{
		// get CI instance 
		$CI =& get_instance();

		// get the constants for the current application
		$oConstants = $CI->db
			->get_where('const', array('application_id' => APPLICATION_ID))
		;

		// loop through each record and define as a site constant
		foreach( $oConstants->result() as $oConstant ) {
			$sConstantName = 'CONST_'. $oConstant->name;
			$sConstantValue = $oConstant->value;
			define($sConstantName, $sConstantValue);
		}
	}

	private function _get_data()
	{
		$CI =& get_instance();

		// $rows = $CI->db->get('const')->result();
		$rows = $CI->db->get_where('const', array('application_id' => APPLICATION_ID))->result();

		$data = array();

		foreach($rows as $row){
			$data[$row->name] = $row->value;
		}

		return $data;
	}

	public function __get($key)
	{
		if(is_null($this->_data)){
			$this->_data = $this->_get_data();
		}

		if(array_key_exists($key, $this->_data)){
			return $this->_data[$key];
		}

		throw new Exception("Unknown Constant '{$key}'", 1);		
	}

}

/* End of file constants.php */
/* Location: ./application/models/constants.php */