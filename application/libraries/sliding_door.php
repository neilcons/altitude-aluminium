<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sliding_Door extends Database_Table_Object
{
	protected $_table_name = 'sliding_door';

	public function get_hidden_fields($which = "all")
	{
		$CI =& get_instance();
		$CI->load->helper('array');

		switch ($which) {
			case 'step2':
				return elements(
					array(
							'opening'
						,	'sliding_door_scheme_id'
						// ,	'sliding_direction'
						,	'width'
						,	'height'
						,	'main_handle_internal_colour_id'
						,	'main_handle_external_colour_id'
						,	'master_handle'
						,	'slave_handle_colour_id'
						,	'tint_id'
						,	'energy_efficient'
						,	'triple_glazing'
						,	'glass_id'
						,	'anti_sun'
						,	"blind_id"
						,	'midrail'
						,	'internal_colour_id'
						,	'external_colour_id'
						,	'midrail'
						,	'trickle_vent'
						,	'hinge_colour_id'
						,	'cill'
						,	'magnets'
						,	'threshold_id'
					), $this->_data, '');
			default:
				return $this->_data;
				break;
		}
	}

	public function has_triple_glazing()
	{
		return $this->triple_glazing;
	}

	public function has_trickle_vents()
	{
		return $this->trickle_vent;
	}

	public function has_anti_sun()
	{
		return $this->anti_sun;
	}

	public function has_magnets()
	{
		return $this->magnets == 1;
	}

	public function print_string($field)
	{
		return ucfirst($this->_print_string($field));
	}

	public function _print_string($field)
	{
		switch ($field) {
			case 'glass':
				return $this->glass->name;

			case 'blind':
				if($blind = $this->blinds){
					return $blind->friendly_name;
				} else {
					return "none";
				}

			case 'opening':
				return $this->opening;
				break;

			case 'threshold':
				if($threshold = $this->threshold){
					return $threshold->name;
				} else {
					return "Don't Know";
				}

			case 'specification':
				$CI =& get_instance();
				return '<br> &nbsp; &nbsp; - ' . str_replace(",", "<br> &nbsp; &nbsp; - ", $CI->db->get_where('specification', array('application_id' => APPLICATION_ID, 'id' => $this->specification))->row('specification'));
				break;

			case 'main_handle_external_colour_id':
				return $this->master_handle_colour->name;
				break;

			case 'cill':
				switch($this->cill){
					case 0:
					return 'None';
					default:
					$CI =& get_instance();
					return $CI->db->get_where('bifold_cill', array('id'=>$this->cill))->row('name');
				}
			case 'trickle_vent':
				switch($this->trickle_vent){
					case -1:
					return 'Don\'t Know';
					case 0:
					return 'None';
					case 1:
					return 'Yes';
				}	
			case 'magnets':
				switch($this->has_magnets()){
					case TRUE:
					return 'Yes';
					default:
					return 'No';
				}

			case 'drainage':
				switch($this->drainage){
					case -1:
					return 'Don\'t Know';
					case 0:
					return 'Not Required';
					case 1:
					return 'Required';
				}

			case 'triple_glazing':
				switch($this->triple_glazing){
					case -1:
					return 'Don\'t Know';
					case 0:
					return 'No';
					case 1:
					return 'Yes';
				}

			case 'glass_id':
				switch($this->glass_id) {
					case 1:
						return 'No';
						break;
					case 2:
						return 'Yes';
						break;
				}

			case 'tint_id':
				switch($this->tint_id) {
					case 1:
						return 'Clear';
						break;
					case 2:
						return 'Bronze';
						break;
					case 3:
						return 'Grey';
						break;
				}

			case 'energy_efficient':
				switch($this->energy_efficient) {
					case 0:
						return 'No';
						break;
					case 1:
						return 'Yes';
						break;
				}

			case 'anti_sun':
				switch($this->anti_sun){
					case 0:
					return 'No';
					case 1:
					return 'Yes';
				}

			case 'midrail':
				switch($this->midrail){
					case 0:
					return 'None';
					case 1:
					return 'Yes';
				}

			// case 'slide_direction':
				// return $this->sliding_direction;

			case 'external_colour':
				return $this->external_colour->name;

			case 'internal_colour':
				return $this->internal_colour->name;

			case 'master_handle':
				return $this->master_handle_colour->name;

			case 'slave_handle_colour_id':
				return $this->slave_handle_colour->name;

			case 'hinge_colour':
				return $this->hinge_colour->name;

			case 'thandle':
				return $this->thandle_colour->name;

            case 'width':
                return $this->width;

            case 'height':
                return $this->height;

			default:
				return "[\${$field}]";
				break;
		}
	}

	public function get_total($include_vat = TRUE)
	{
		try {
			$CI =& get_instance();

			$CI->load->model('bifold_pricer');

			return $CI->bifold_pricer->get_price($this) * ($include_vat ? 1.2 : 1);
		} catch (Exception $e) {
			return -1;
		}
	}

	public function get_breakdown()
	{
		try {
			$CI =& get_instance();

			$CI->load->model('bifold_pricer');

			return $CI->load->view('price-breakdown', array('prices'=>$CI->bifold_pricer->price_breakdown($this)), TRUE);
		} catch (Exception $e) {
			return -1;
		}
	}

	public function get_outer_ral()
	{
		return $this->external_colour->RAL;
	}

	public function set_defaults()
	{
		$this->load(1);
		unset($this->_data['date']);
		$this->_id = NULL;
	}

	public function is_open_in()
	{
		return $this->opening == 'in';
	}

	public function has_blinds()
	{
		$var = $this->blind_id;
		return !empty($var);
	}

	public function has_midrail()
	{
		return $this->midrail == 1;
	}

	public function has_handle()
	{
		// return ($this->bifold_scheme->master_handle_left == 1) OR ($this->bifold_scheme->master_handle_right == 1);

		return true;

		/* always has a handle
		if( $this->sliding_door_scheme->number_panels_left % 2 == 0 && $this->sliding_door_scheme->number_panels_right % 2 == 0 ) {
			return false;
		} else {
			return true;
		}
		*/

	}

	public function _get_sliding_door_scheme()
	{
		$oScheme = new Sliding_Door_Scheme();
		// $oScheme = new Bifold_Scheme();
		$oScheme->load($this->sliding_door_scheme_id);

		return $oScheme;
	}

/*
	public function get_panel_with_handle()
	{
		// set position of handle for LEFT sliding selection
		if( $this->sliding_direction == 'left' ) {

			// set correct position of handle based
			if( $this->handle_position == 'left' ) {
				// handle on left
				$panel = $this->sliding_door_scheme->number_panels_left;
			} else {
				// handle on right
				$panel = $this->sliding_door_scheme->number_panels - $this->sliding_door_scheme->number_panels_right;
			}

		// set position of handle for RIGHT sliding selection
		} else {

			// set correct position of handle based
			if( $this->handle_position == 'left' ) {
				// handle on left
				$panel = $this->sliding_door_scheme->number_panels - $this->sliding_door_scheme->number_panels_left;
			} else {
				// handle on right
				$panel = $this->sliding_door_scheme->number_panels_right;
			}
		}

		// if handle position is to the right, push one panel to the right to correctly position the handle
		if($this->handle_position == 'right'){
			$panel++;
		}
		return $panel;
	}
*/

	public function get_panel_count()
	{
		// echo("<pre>"); var_dump($this); exit;
		return $this->sliding_door_scheme->number_panels;
	}

	public function _get_external_colour()
	{
		$external_colour = new Colour();
		$external_colour->load($this->external_colour_id);

		return $external_colour;
	}

	public function _get_internal_colour()
	{
		$internal_colour = new Colour();
		$internal_colour->load($this->internal_colour_id);

		return $internal_colour;
	}

	public function _get_master_handle_colour()
	{
		// $master_handle_colour->load($this->master_handle);
		
		// get the external handle colour from the new [main_handle_external_colour_id] field
		$master_handle_colour = new Bifold_Hardware_Colour();
		// $master_handle_colour->load($this->master_handle);
		$master_handle_colour->load($this->main_handle_external_colour_id);

		return $master_handle_colour;
	}

	public function _get_slave_handle_colour()
	{
		$slave_handle_colour = new Bifold_Hardware_Colour();
		$slave_handle_colour->load($this->slave_handle_colour_id);

		return $slave_handle_colour;
	}

	public function _get_thandle_colour()
	{
		$master_handle_colour = new Bifold_Hardware_Colour();
		$master_handle_colour->load($this->thandle);

		return $master_handle_colour;
	}

	public function _get_glass()
	{
		$glass = new Glass();

		$glass->load($this->glass_id);

		return $glass;
	}

	public function _get_blinds()
	{
		if(my_empty($this->blind_id)){
			return FALSE;
		}
		$blinds = new Blinds();
		$blinds->load($this->blind_id);
		return $blinds;
	}

	public function _get_threshold()
	{
		if(my_empty($this->threshold_id)){
			return FALSE;
		}
		$threshold = new Bifold_Threshold();
		$threshold->load($this->threshold_id);
		return $threshold;
	}

	public function get_blinds_ral()
	{
		return $this->blinds->RAL;
	}

/*
	public function does_slide_left()
	{
		return $this->sliding_direction == 'left';
	}
*/

	public function get_hinge_colour()
	{
		$hinge_colour = new Bifold_Hardware_Colour();
		$hinge_colour->load($this->hinge_colour_id);

		return $hinge_colour->RAL;
	}

	public function get_glazing_width()
	{
		return $this->width - $this->sliding_door_scheme->width_deduction * $this->sliding_door_scheme->number_panels;
	}

	public function get_glazing_height()
	{
		$height =  $this->height - $this->sliding_door_scheme->height_deduction;

		if($this->threshold_id <> 1){
			$height += 17;
		}

		if($this->cill > 0){
			$height -= 25;
		}

		if($this->has_trickle_vents()){
			$height -= 42;
		}

		return $height;
	}

	public function get_glazing_area_in_meters()
	{
		$size = $this->get_glazing_width() * $this->get_glazing_height() / 1000000;
		return $size;
	}

	public function __get($key)
	{
		if($key === 'hinge_colour'){
			$hinge_colour = new Bifold_Hardware_Colour();
			$hinge_colour->load($this->hinge_colour_id);
			return $hinge_colour;
		}

		if($key === 'bifold_scheme'){
			return $this->_get_bifold_scheme();
		}

		if($key === 'sliding_door_scheme'){
			return $this->_get_sliding_door_scheme();
		}

		if($key === 'external_colour'){
			return $this->_get_external_colour();
		}

		if($key === 'internal_colour'){
			return $this->_get_internal_colour();
		}

		if($key === 'master_handle_colour'){
			return $this->_get_master_handle_colour();
		}

		if($key === 'slave_handle_colour'){
			return $this->_get_slave_handle_colour();
		}

		if($key === 'thandle_colour'){
			return $this->_get_thandle_colour();
		}

		if($key === 'blinds'){
			return $this->_get_blinds();
		}

		if($key === 'glass'){
			return $this->_get_glass();
		}

		if($key === 'threshold'){
			return $this->_get_threshold();
		}

		if($key === 'id'){
			$this->save();
		}


		return parent::__get($key);
	}

	public function get_price_column()
	{
		if($this->external_colour_id != $this->internal_colour_id){
			return 'price_dual';
		} else {
			if(in_array($this->external_colour_id, array(44, 42))){
				return 'price_white_grey';
			} else {
				return 'price_ral_kl_sensation';
			}
		}
	}

	public function get_master_handle_ral_colour()
	{
		return $this->master_handle_colour->RAL;
	}

	public function width_in_meters()
	{
		return $this->width / 1000;
	}

	public function get_display_width()
	{
		$CI =& get_instance();
		if($this->width < $CI->constants->MIN_WIDTH_FRAME OR $this->width > $CI->constants->MAX_WIDTH_FRAME){
			return NULL;
		}

		return $this->width;
	}

	public function get_display_height()
	{
		$CI =& get_instance();
		if($this->height < $CI->constants->MIN_HEIGHT_PANEL OR $this->height > $CI->constants->MAX_HEIGHT_PANEL){
			return NULL;
		}
		return $this->height;
	}

	public function __set($key, $value)
	{
		switch ($key) {
			case 'width':
				$CI =& get_instance();
				$value = (int) $value;
				$value = (int) min(max($value, $CI->constants->MIN_WIDTH_FRAME), $CI->constants->MAX_WIDTH_FRAME);
				break;
			case 'height':
				$CI =& get_instance();
				$value = (int) $value;
				$value = (int) min(max($value, $CI->constants->MIN_HEIGHT_PANEL), $CI->constants->MAX_HEIGHT_PANEL);
				break;
		}
		
		return parent::__set($key, $value);
	}


	/**
	 * get the min and max widths and heights from the ags_scheme data
	 * 	@return array results of min and max data
	 */
	public function get_min_max_widths_and_heights() 
	{
		// load codeigniter
		$CI = &get_instance();

		// set variable for final values
		$aResult = array();

		// get the data for the min and max widths
		$oQuery = $CI->db->query('SELECT MIN(min_width) AS min_width, MAX(max_width) AS max_width FROM sliding_door_scheme');

		// ensure we have one row 
		if($oQuery->num_rows() == 1) {
			// get this row of data
			$oRow = $oQuery->row();

			// put this data into our array
			$aResult['min_width'] = $oRow->min_width;
			$aResult['max_width'] = $oRow->max_width;
		}

		// get the data for the min and max heights
		$oQuery = $CI->db->query('SELECT MIN(height_up_to) AS min_height, MAX(height_up_to) AS max_height FROM sliding_door_scheme_price_matrix');

		// ensure we have one row
		if($oQuery->num_rows() == 1) {
			// get this row of data
			$oRow = $oQuery->row();

			// set our data
			$aResult['min_height'] = $oRow->min_height;
			$aResult['max_height'] = $oRow->max_height;
		}

		// return the final data
		return $aResult;
	}


	/**
	 * get the id of the record and fill up with zeros
	 */
	public function reference()
	{
		return str_pad($this->id, 7, '0', STR_PAD_LEFT);
	}


	/**
	 * get the latest records entered into the table
	 */
	public function get_latest_orders()
	{
		// load instance of the database via codeigniter instance
		$DB = &get_instance()->db;

		/*
		// set the fields required from the query in the following format 'table.field_name' => 'alias'
		$aFields = array(
			'bifold_door.date'						=> 'date'
		,	'bifold_door.id'						=> 'id'
		,	'bifold_door.width'						=> 'width'
		,	'bifold_door.height'					=> 'height'
		,	'bifold_scheme.style'					=> 'configuration'
		,	'external_colour.name'					=> 'external_colour'
		,	'internal_colour.name'					=> 'internal_colour'
		,	'bifold_door.opening'					=> 'opening'
		,	'bifold_door.external_colour_finish'	=> 'external_colour_finish'
		,	'bifold_door.internal_colour_finish'	=> 'internal_colour_finish'
		,	'traffic_handle_colour.name'			=> 'traffic_handle_colour'
		,	'hinge_colour.name'						=> 'hinge_colour'
		,	'slave_colour.name'						=> 'slave_handle_colour'
		,	'bifold_door.triple_glazing'			=> 'triple_glazing'
		,	'tint.name'								=> 'tint'
		,	'bifold_door.glass_id'					=> 'self_cleaning'
		,	'bifold_door.energy_efficient'			=> 'energy_efficient'
		,	'bifold_door.trickle_vent'				=> 'trickle_vent'
		,	'bifold_cill.name'						=> 'cill'
		,	'bifold_threshold.name'					=> 'threshold'
		,	'bifold_door.supply_type'				=> 'supply_type'
		,	'bifold_door.your_name'					=> 'customer_name'
		,	'bifold_door.your_address'				=> 'customer_address'
		,	'bifold_door.your_postcode'				=> 'customer_postcode'
		,	'bifold_door.your_email'				=> 'customer_email'
		,	'bifold_door.your_tel'					=> 'customer_telephone'
		);

		// stringify the array of fields
		$sSelectFields = '';
		foreach( $aFields as $field => $alias ) {
			$sSelectFields .= $field .' AS '. $alias .', ';
		}
		$sSelectFields = substr($sSelectFields, 0, strlen($sSelectFields)-2);

		// build the query
		$DB->select($sSelectFields);
		$DB->from('bifold_door');
		$DB->join('bifold_scheme', 'bifold_scheme.id = bifold_door.bifold_scheme_id');
		$DB->join('colour AS external_colour', 'external_colour.id = bifold_door.external_colour_id');
		$DB->join('colour AS internal_colour', 'internal_colour.id = bifold_door.internal_colour_id');
		$DB->join('bifold_hardware_colour AS traffic_handle_colour', 'traffic_handle_colour.id = bifold_door.master_handle');
		$DB->join('bifold_hardware_colour AS hinge_colour', 'hinge_colour.id = bifold_door.hinge_colour_id');
		$DB->join('bifold_hardware_colour AS slave_colour', 'slave_colour.id = bifold_door.slave_handle_colour_id');
		$DB->join('tint', 'tint.id = bifold_door.tint_id');
		$DB->join('bifold_cill', 'bifold_cill.id = bifold_door.cill');
		$DB->join('bifold_threshold', 'bifold_threshold.id = bifold_door.threshold_id');
		$DB->order_by('bifold_door.id', 'desc');
		*/

		// set variable to hold the results
		$aResult = array();

		// build the query
		$DB->select('sliding_door.id, sliding_door.created_at AS date, sliding_door.your_name, sliding_door.your_address, sliding_door.your_postcode, sliding_door.your_email, sliding_door.your_tel');
		$DB->from('sliding_door');
		$DB->where('sliding_door.id >', 1);
		$DB->order_by('sliding_door.id', 'desc');

		// get the results
		$sQuery = $DB->get();

		// push the results into the storage array
		foreach( $sQuery->result() as $row ) {
			array_push($aResult, $row);
		}

		// return the data
		return $aResult;
	}



	/**
	 * get bifold record when given a bifold id
	 */
	public function get_door($id)
	{
		// load instance of the database via codeigniter instance
		$DB = &get_instance()->db;

		// set variable to hold the results
		$aResult = array();

		// set the fields required from the query in the following format 'table.field_name' => 'alias'
		$aFields = array(
			'sliding_door.created_at'						=> 'date'
		,	'sliding_door.id'								=> 'id'
		,	'sliding_door.width'							=> 'width'
		,	'sliding_door.height'							=> 'height'
		,	'external_colour.name'							=> 'external_colour'
		,	'external_colour.RAL'							=> 'external_colour_ral'
		,	'internal_colour.name'							=> 'internal_colour'
		,	'internal_colour.RAL'							=> 'internal_colour_ral'
		,	'sliding_door.specification'					=> 'specification'
		,	'sliding_door.opening'							=> 'opening'
		,	'sliding_door.external_colour_finish'			=> 'external_colour_finish'
		,	'sliding_door.internal_colour_finish'			=> 'internal_colour_finish'
		,	'handle_colour.name'							=> 'external_handle_colour'
		,	'sliding_door.triple_glazing'					=> 'triple_glazing'
		,	'sliding_door.glass_id'							=> 'self_cleaning'
		,	'sliding_door.tint_id'							=> 'tint_id'
		,	'sliding_door.energy_efficient'					=> 'energy_efficient'
		,	'sliding_door.trickle_vent'						=> 'trickle_vent'
		,	'sliding_door.supply_type'						=> 'supply_type'
		,	'sliding_door.your_name'						=> 'your_name'
		,	'sliding_door.your_address'						=> 'your_address'
		,	'sliding_door.your_postcode'					=> 'your_postcode'
		,	'sliding_door.your_email'						=> 'your_email'
		,	'sliding_door.your_tel'							=> 'your_telephone'
		,	'sliding_door.quote_price'						=> 'quote_price'
		,	'sliding_door.quote_price_with_vat'				=> 'quote_price_with_vat'
		);

		// set variable to hold the results
		$aResult = array();

		// stringify the array of fields
		$sSelectFields = '';
		foreach( $aFields as $field => $alias ) {
			$sSelectFields .= $field .' AS '. $alias .', ';
		}
		$sSelectFields = substr($sSelectFields, 0, strlen($sSelectFields)-2);

		// build the query
		$DB->select($sSelectFields);
		$DB->from('sliding_door');
		$DB->join('sliding_door_scheme', 'sliding_door_scheme.id = sliding_door.sliding_door_scheme_id', 'left');
		$DB->join('colour AS external_colour', 'external_colour.id = sliding_door.external_colour_id', 'left');
		$DB->join('colour AS internal_colour', 'internal_colour.id = sliding_door.internal_colour_id', 'left');
		$DB->join('bifold_hardware_colour AS handle_colour', 'handle_colour.id = sliding_door.main_handle_external_colour_id', 'left');
		$DB->where('sliding_door.id', $id);

		// build the query
		$sQuery = $DB->get();

		// get the result
		$aResult = $sQuery->row();

		// return the data
		return $aResult;
	}

}