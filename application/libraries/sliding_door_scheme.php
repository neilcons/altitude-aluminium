<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliding_Door_Scheme extends Database_Table_Object
{
	protected $_table_name = 'sliding_door_scheme';

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
	 * get the basic price based on the scheme id and price type
	 */
	public function get_basic_price($scheme_id, $scheme_price_type_id, $width, $height, $glass_type_id = 1) 
	{
		// load codeigniter
		$CI = &get_instance();

		// set variable for final values
		$aResult = array();

		// set array with criteria
		$aWhereCriteria = array(
			'sliding_door_scheme_id ='			=> $scheme_id
		,	'sliding_door_scheme_price_type_id'	=> $scheme_price_type_id
		,	'glass_type_id'						=> $glass_type_id
		,	'width_up_to >='					=> $width
		,	'width_up_to <='					=> $width + 99
		,	'height_up_to >='					=> $height
		,	'height_up_to <='					=> $height + 99
		);

		// run the query
		$oQuery = $CI->db->where($aWhereCriteria)->get('sliding_door_scheme_price_matrix');

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