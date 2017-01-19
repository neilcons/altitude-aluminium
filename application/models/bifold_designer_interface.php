<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Designer_Interface extends CI_Model {

	public function make_dropdown($results, $name_field = 'name', $key = 'id')
	{
		$ret = array();

		foreach ($results as $result) {
			$ret[$result->$key] = $result->$name_field;
		}

		return $ret;
	}

	public function get_colour_range_dropdown()
	{
		$ret = array();

		foreach($this->db->get('colour_range')->result() as $row){
			$ret[$row->id] = $row->name;
		}

		return $ret;
	}

	public function get_master_handle_colours()
	{
		return $this->db->get('bifold_hardware_colour')->result();
	}
	public function get_thandle_colours()
	{
		return $this->db->get('bifold_hardware_colour')->result();
	}

	public function get_glass_options()
	{
		return $this->db->get('glass')->result();
	}
	public function get_blind_colours()
	{
		return $this->db->get('blinds')->result();
	}

	public function get_standard_colour_range()
	{
		return $this->db->get_where('colour', array('colour_range_id'=>1))->result();
	}

	public function get_made_to_order_colour_range()
	{
		return $this->db->get_where('colour', array('colour_range_id'=>2))->result();
	}

	public function get_cill_dropdown()
	{
		return array(-1=>'Don\'t know', 'No', 'Yes');
	}

	public function get_tricklevent_dropdown()
	{
		return array(-1=>'Don\'t know', 'No', 'Yes');
	}

	public function get_midrail_dropdown()
	{
		return array('No', 'Yes');
	}

	public function get_threshold_options()
	{
		return $this->db->get('Bifold_Threshold')->result();
	}

	public function get_drainage_dropdown()
	{
		return array(-1=>'Don\'t know', 'Not Required', 'Required');
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */