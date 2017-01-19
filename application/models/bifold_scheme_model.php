<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Scheme_Model extends CI_Model {

	public function get_available_schemes_for_width($width)
	{
		return $this->db->order_by('number_panels, number_panels_left')->get_where('bifold_scheme',
			array('min_width <='=>$width, 'max_width >='=>$width)
			)->result('bifold_scheme');
	}


	public function get_all_schemes()
	{
		return $this->db->order_by('number_panels, number_panels_left')->get('bifold_scheme')->result('bifold_scheme');
	}
}

/* End of file bifold_scheme_model.php */
/* Location: ./application/models/bifold_scheme_model.php */