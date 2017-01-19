<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_scheme_price_matrix_model extends CI_Model {

	public function load_schemes_for_editing()
	{
		$results = $this->db->query("SELECT bifold_scheme.id [bifold_scheme_id], min_width, [bifold_scheme_price_matrix].id [bifold_scheme_price_matrix_id], width_up_to, height_up_to, price_white_grey, price_ral_kl_sensation, price_dual, width_deduction, height_deduction FROM [mybifold].[dbo].[bifold_scheme] JOIN [bifold_scheme_price_matrix] ON [bifold_scheme_id] = bifold_scheme.id ORDER BY number_panels, number_panels_left DESC, width_up_to, height_up_to")->result();

		$return = array();

		foreach($results as $result){
			$return[$result->bifold_scheme_id][$result->width_up_to]['price_white_grey'][$result->height_up_to]['price'] = $result->price_white_grey;
			$return[$result->bifold_scheme_id][$result->width_up_to]['price_ral_kl_sensation'][$result->height_up_to]['price'] = $result->price_ral_kl_sensation;
			$return[$result->bifold_scheme_id][$result->width_up_to]['price_dual'][$result->height_up_to]['price'] = $result->price_dual;
			$return[$result->bifold_scheme_id][$result->width_up_to]['price_white_grey'][$result->height_up_to]['bifold_scheme_price_matrix_id'] = $result->bifold_scheme_price_matrix_id;
			$return[$result->bifold_scheme_id][$result->width_up_to]['price_ral_kl_sensation'][$result->height_up_to]['bifold_scheme_price_matrix_id'] = $result->bifold_scheme_price_matrix_id;
			$return[$result->bifold_scheme_id][$result->width_up_to]['price_dual'][$result->height_up_to]['bifold_scheme_price_matrix_id'] = $result->bifold_scheme_price_matrix_id;
			if(empty($return[$result->bifold_scheme_id][$result->width_up_to]['bifold_scheme'])){
				$return[$result->bifold_scheme_id][$result->width_up_to]['bifold_scheme'] = new Bifold_Scheme();
				$return[$result->bifold_scheme_id][$result->width_up_to]['bifold_scheme']->load($result->bifold_scheme_id);
			}
		}

		return $return;
	}

	public function update_prices($price_array)
	{
		foreach ($price_array as $id => $prices) {
			$this->db->where('id', $id)->update('bifold_scheme_price_matrix', $prices);
		}

	}

	public function update_widths($width_array)
	{
		foreach($width_array as $scheme_id=>$widths){
			foreach($widths as $old_width=>$new_width){
				$this->db->where(array('bifold_scheme_id'=>$scheme_id, 'width_up_to'=>$old_width))->update('bifold_scheme_price_matrix', array('width_up_to'=>$new_width));
			}
		}
	}

	public function update_deductions($bifold_schemes)
	{
		foreach($bifold_schemes as $scheme_id=>$data){
			$this->db->where(array('id'=>$scheme_id))->update('bifold_scheme', $data);
		}
	}

	public function update_extras($extras)
	{
		foreach($extras as $extra_id=>$data){
			$this->db->where(array('id'=>$extra_id))->update('bifold_extra', $data);
		}
	}

	public function update_cills($cills)
	{
		foreach($cills as $cill_id=>$data){
			$this->db->where(array('id'=>$cill_id))->update('bifold_cill', $data);
		}
	}
}

/* End of file bifold_scheme_price_matrix_model.php */
/* Location: ./application/models/bifold_scheme_price_matrix_model.php */