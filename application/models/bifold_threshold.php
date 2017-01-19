<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Threshold extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function get_thresholds() 
	{
		// instantiate db
		$DB = &get_instance()->db;

		// set the order
		$DB->order_by('id', 'asc');
		
		// run query to get the data
		$query = $DB->get('bifold_threshold');
		
		// return the results
		return $query->result();
	}

}