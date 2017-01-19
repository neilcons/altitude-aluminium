<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Specification extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function get_specifications() 
	{
		// instantiate db
		$DB = &get_instance()->db;

		// set the order
		$DB->where('application_id', APPLICATION_ID);

		// run query to get the data
		$query = $DB->get('specification');

		// return the results
		return $query->result();
	}


	public function get_specification_by_id($id)
	{
		// instantiate db
		$DB = &get_instance()->db;

		// set criteria
		$aCriteria = array(
			'application_id'	=> APPLICATION_ID,
			'id'				=> $id,
		);

		// run query to get the data
		$query = $DB->get_where('specification', $aCriteria);

		// return the results
		return $query->row();
	}

}