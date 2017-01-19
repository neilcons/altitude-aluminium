<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Colour extends Database_Table_Object
{
	protected $_table_name = 'colour';

	/**
	 * get a colour record when given its id
	 */
	public function get_colour_by_id($id)
	{
		// get instance of the db via the CodeIgniter instance
		$DB = &get_instance()->db;

		// get the query
		$query = $DB->get_where('colour', array('id'=>$id));

		// return the result
		return $query->row();
	}

}