<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Hardware extends Database_Table_Object
{
	protected $_table_name = 'bifold_hardware';

	public function get_hardware_by_name($param_hardware_name)
	{
		// get instance of the db via the CodeIgniter instance
		$DB = &get_instance()->db;

		// get the query
		$query = $DB->get_where('bifold_hardware', array('name'=>$param_hardware_name));

		// get the result
		$aHardware = $query->result();

		// if we have a result, return the id
		if( is_array($aHardware) && count($aHardware) == 1 ) {
			return $aHardware[0];
		}
	}

}

/* End of file casement_window.php */
/* Location: ./application/libraries/casement_window.php */
