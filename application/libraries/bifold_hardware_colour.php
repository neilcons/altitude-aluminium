<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Hardware_Colour extends Database_Table_Object
{
	protected $_table_name = 'bifold_hardware_colour';

	public function get_hardware_colours_by_hardware_name($param_hardware_name)
	{
		// get the hardware id from the name
		$oHardwareModel = new Bifold_Hardware();
		$oHardware = $oHardwareModel->get_hardware_by_name($param_hardware_name);

		// get instance of the db via the CodeIgniter instance
		$DB = &get_instance()->db;

		$DB->select('bifold_hardware_hardware_colour.bifold_hardware_colour_id, bifold_hardware_colour.name, bifold_hardware_colour.RAL, bifold_hardware_hardware_colour.default, bifold_hardware_colour.hex_code');
		$DB->from('bifold_hardware_hardware_colour');
		$DB->join('bifold_hardware_colour', 'bifold_hardware_colour.id = bifold_hardware_hardware_colour.bifold_hardware_colour_id');
		$DB->where('bifold_hardware_hardware_colour.bifold_hardware_id', $oHardware->id);

		// execute the query
		$query = $DB->get();

		// get the results of the query and place into data array
		$aResults = array();
		foreach( $query->result() as $row ) {
			array_push($aResults, $row);
		}

		// return results
		return $aResults;
	}

}

/* End of file casement_window.php */
/* Location: ./application/libraries/casement_window.php */
