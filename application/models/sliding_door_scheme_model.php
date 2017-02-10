<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliding_Door_Scheme_Model extends CI_Model {

	public function get_available_schemes_for_width($width, $height)
	{
        $width = (int) $width;
        $height = (int) $height;

		return $this->db
            ->join('sliding_door_scheme_price_matrix', 'sliding_door_scheme.id = sliding_door_scheme_price_matrix.sliding_door_scheme_id')
			->order_by('number_panels')
            ->select('sliding_door_scheme.*')
            ->distinct()
            ->where_in('sliding_door_scheme_price_type_id', [1, 2])
			->get_where('sliding_door_scheme', array(
                'width_up_to >=' => $width,
                'height_up_to >=' => $height,
                'width_up_to <=' => $width + 100,
                'height_up_to <=' => $height + 100,
                'min_width <=' => $width,
                'max_width >=' => $width,
            ))
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