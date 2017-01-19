<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Cill extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}


	public function get_cills() 
	{
		// instantiate db
		$DB = &get_instance()->db;

		// set the order
		$DB->order_by('name', 'asc');
		
		// run query to get the data
		$query = $DB->get('bifold_cill');
		
		// return the results
		return $query->result();
	}


	public function get_cill_by_id($id)
	{
		// instantiate db
		$DB = &get_instance()->db;

		// run query to get the data
		$query = $DB->get_where('bifold_cill', array('id'=>$id));
		
		// return the results
		return $query->row();

	}

}