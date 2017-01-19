<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliding_Door_Scheme_Model extends CI_Model {

	public function get_available_schemes_for_width($width)
	{
		return $this->db
			->order_by('number_panels')
			->get_where('sliding_door_scheme', array('min_width <=' => $width, 'max_width >=' => $width))
			->result('sliding_door_scheme')
		;
	}

	/*
	public function get_all_schemes()
	{
		return $this->db->order_by('number_panels, number_panels_left')->get('sliding_door_scheme')->result('sliding_door_scheme');
	}
	*/
}

/* End of file bifold_scheme_model.php */
/* Location: ./application/models/bifold_scheme_model.php */