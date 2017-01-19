<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Pricer extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_frame_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		$ret->qty = 1;
		if($ret->qty > 0){
			$which_price = $bifold->get_price_column();
			$ret->description = "Frame [{$which_price}] {$bifold->width}x{$bifold->height}";
			$CI =& get_instance();

			$ret->price = $CI->db->select_min($which_price)->where(array('bifold_scheme_id'=>$bifold->bifold_scheme_id, 'width_up_to >='=>$bifold->width, 'height_up_to >='=>$bifold->height))->get('bifold_scheme_price_matrix')->row($which_price);
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_cill_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		$ret->qty = $bifold->cill > 0;
		if($ret->qty > 0){
			$ret->qty = $bifold->width_in_meters();
			$which_price = $bifold->get_price_column();
			$ret->description = "Cill [{$which_price}]";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('id'=>$bifold->cill))->get('bifold_cill')->row($which_price);
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_addon_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		$ret->qty = $bifold->trickle_vent > 0;
		if($ret->qty > 0){
			$ret->qty = $bifold->width_in_meters();
			$which_price = $bifold->get_price_column();
			$ret->description = "Frame Extender [{$which_price}]";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('id'=>1))->get('bifold_add_on')->row($which_price);
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_vent_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		if($bifold->trickle_vent > 0){
			$ret->qty = ($bifold->bifold_scheme->number_panels > 2) ? 2 : 1;
		} else {
			$ret->qty = 0;
		}

		if($ret->qty > 0){
			$ret->description = "Trickle Vent";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('name'=>'5000mm head vent'))->get('bifold_extra')->row('price');
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_blinds_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		if($bifold->has_blinds()){
			$ret->qty = $bifold->bifold_scheme->number_panels;
		} else {
			$ret->qty = 0;
		}

		if($ret->qty > 0){
			$ret->description = "Blinds";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('name'=>'Integral Blinds'))->get('bifold_extra')->row('price');
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_midrail_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		if($bifold->has_midrail()){
			$ret->qty = $bifold->width_in_meters();
		} else {
			$ret->qty = 0;
		}

		if($ret->qty > 0){
			$ret->description = "Midrail";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('name'=>'Midrail'))->get('bifold_extra')->row('price');
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_small_magnets_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		if($bifold->has_magnets()){
			$ret->qty = $bifold->bifold_scheme->small_magnets;
		} else {
			$ret->qty = 0;
		}

		if($ret->qty > 0){
			$ret->description = "Small Magnets";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('name'=>'Small magnet for pendulum handle'))->get('bifold_extra')->row('price');
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_large_magnets_cost(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		if($bifold->has_magnets()){
			$ret->qty = $bifold->bifold_scheme->large_magnets;
		} else {
			$ret->qty = 0;
		}

		if($ret->qty > 0){
			$ret->description = "Large Magnets";
			$CI =& get_instance();

			$ret->price = $CI->db->where(array('name'=>'Large Magnet for main handle'))->get('bifold_extra')->row('price');
			$ret->discount = 0;
		}

		return $ret;
	}

	public function get_glass_price(Bifold_Door $bifold)
	{
		$ret = new Bifold_Price_Row();

		$ret->qty = $bifold->get_glazing_area_in_meters();

		$ret->description = "Glass";
		$CI =& get_instance();

		$ret->price = $CI->db->where(array('name'=>'Std Glass'))->get('bifold_extra')->row('price');

		if($bifold->has_triple_glazing()){
			$ret->price += $CI->db->where(array('name'=>'Triple Glazed'))->get('bifold_extra')->row('price');
			$ret->description .= " Triple Glazed";
		}

		if($bifold->has_anti_sun()){
			$ret->price += $CI->db->where(array('name'=>$bifold->has_triple_glazing() ? 'Anti Sun On Triple uplift' : 'Anti Sun On Std Uplift'))->get('bifold_extra')->row('price');
			$ret->description .= " + " . ($bifold->has_triple_glazing() ? 'Anti Sun On Triple uplift' : 'Anti Sun On Std Uplift');
		}

		$ret->discount = 0;

		return $ret;
	}

	public function price_breakdown(Bifold_Door $bifold)
	{
		$ret = array();

		$ret[] = $this->get_frame_cost($bifold);
		$ret[] = $this->get_cill_cost($bifold);
		$ret[] = $this->get_addon_cost($bifold);
		$ret[] = $this->get_vent_cost($bifold);
		$ret[] = $this->get_blinds_cost($bifold);
		$ret[] = $this->get_midrail_cost($bifold);
		$ret[] = $this->get_small_magnets_cost($bifold);
		$ret[] = $this->get_large_magnets_cost($bifold);
		$ret[] = $this->get_glass_price($bifold);

		return $ret;
	}

	public function get_price(Bifold_Door $bifold)
	{
		$total = 0;
		foreach ($this->price_breakdown($bifold) as $value){
			$total += $value->total;
		}

		$total += 150;

		if(strtoupper($bifold->voucher_code) != 'MYB10'){
			return $total * 1.1111111111;
		} else {
			return $total;
		}
	}
}

/* End of file casement_window.php */
/* Location: ./application/models/casement_window.php */