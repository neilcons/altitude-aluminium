<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Colour_Range extends Database_Table_Object
{
	protected $_table_name = 'colour_range';

	public function get_all_colours()
	{
		$CI =& get_instance();
		return $CI->db->get_where('colour', array('colour_range_id'=>$this->id))->result('Colour');
	}
}

/* End of file casement_window.php */
/* Location: ./application/libraries/casement_window.php */
