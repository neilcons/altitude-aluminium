<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Scheme extends Database_Table_Object
{
	protected $_table_name = 'bifold_scheme';

	public function get_thumb_img()
	{
		return base_url("assets/images/schemes/{$this->number_panels}-{$this->number_panels_right}-{$this->number_panels_left}-right.png");
	}
	public function get_thumb_img_left()
	{
		return base_url("assets/images/schemes/{$this->number_panels}-{$this->number_panels_left}-{$this->number_panels_right}-left.png");
	}

	public function get_names()
	{
		$ret = array();
		$ret[$this->name_left] = $this->name_left;
		$ret[$this->name] = $this->name;
		return $ret;
	}


	/**
	 * 
	 */
	public function get_basic_price($bifold_scheme_id, $bifold_scheme_price_type_id, $width, $height) 
	{
		// load codeigniter
		$CI = &get_instance();

		// set variable for final values
		$aResult = array();

		// set array with criteria
		$aWhereCriteria = array(
			'bifold_scheme_id ='			=> $bifold_scheme_id
		,	'bifold_scheme_price_type_id'	=> $bifold_scheme_price_type_id
		,	'width_up_to >='				=> $width
		,	'width_up_to <='				=> $width + 49
		,	'height_up_to >='				=> $height
		,	'height_up_to <='				=> $height + 99
		);

		// run the query
		$oQuery = $CI->db->where($aWhereCriteria)->get('bifold_scheme_price_matrix');

		$aResult = array();

		// ensure we have one row
		if($oQuery->num_rows() == 1) {

			// get this row of data
			$oRow = $oQuery->row();

			// set our data
			$aResult['price'] = $oRow->price;
		}

		// return the final data
		return $aResult;
	}


	/**
	 * 
	 */
	public function get_basic_price_OLD($bifold_scheme_id, $bifold_scheme_price_type_id, $width, $height) 
	{
		// load codeigniter
		$CI = &get_instance();

		// set variable for final values
		$aResult = array();

		// set array with criteria
		$aWhereCriteria = array(
			'bifold_scheme_id ='			=> $bifold_scheme_id
		,	'bifold_scheme_price_type_id'	=> $bifold_scheme_price_type_id
		,	'width_up_to >='				=> $width
		,	'width_up_to <='				=> $width + 49
		,	'height_up_to >='				=> $height
		,	'height_up_to <='				=> $height + 99
		);

		// run the query
		$oQuery = $CI->db->where($aWhereCriteria)->get('bifold_scheme_price_matrix');

		$aResult = array();

		// ensure we have one row
		if($oQuery->num_rows() == 1) {

			// get this row of data
			$oRow = $oQuery->row();

			// set our data
			$aResult['price'] = $oRow->price;
		}

		// return the final data
		return $aResult;
	}


	public function __get($key)
	{
		if($key === 'name'){
			return "{$this->number_panels}-{$this->number_panels_left}-{$this->number_panels_right}";
		}
		if($key === 'name_left'){
			return "{$this->number_panels}-{$this->number_panels_right}-{$this->number_panels_left}";
		}

		return parent::__get($key);
	}
}

/* End of file casement_window.php */
/* Location: ./application/libraries/casement_window.php */