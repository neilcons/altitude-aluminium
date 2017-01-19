<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_Controller extends CI_Controller {

	public function get_scheme_choices()
	{
		// set vars
		$ret = array();
		$ret['status'] = FALSE;
		$ret['html'] = '';

		// load required models
		$this->load->model('sliding_door_scheme_model');

		// get the width
		$width = $this->input->post('width');

		// ensure we have a valid width
		if(is_numeric($width)){

			// get schemes based on width
			$oSchemes = $this->sliding_door_scheme_model->get_available_schemes_for_width($width);

			if(count($oSchemes) > 0){
				$ret['status'] = TRUE;

				$data = array();
				$data['schemes'] = $oSchemes;

				// set all styles returned
				$sConfigs = '';
				foreach( $oSchemes as $key => $scheme ) {
					$sConfigs .= $scheme->style . ( $key != count($oSchemes)-1 ? ',' : '' );
				}
				$ret['styles'] = $sConfigs;

				// set the html to use on the view
				$ret['html'] = $this->load->view('designer/block/configurations', $data, TRUE);
			}
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	}

	public function get_colour_box($which_colour, $colour_id, $match = FALSE)
	{
		$colour = new Colour();
		$colour->load($colour_id);

		// if we need to hide the internal colour option that allows the user to show the option set flag here
		$hide_internal_colour_picker_option = isset($_POST['show_internal_colour_match']) && $_POST['show_internal_colour_match'] == true ? true : false;

		$this->load->view("designer/block/{$which_colour}_colour_choice", array('colour'=>$colour, 'checked'=>$match, 'hide_internal'=>$hide_internal_colour_picker_option));
	}

	public function get_current_image()
	{
		// load the imager class
		$this->load->model('imager');
		
		// set the output for the image
		$this->output
			->set_content_type('image/png')
			->set_output($this->imager->get_image($this->session->current_design));
	}


	public function image($bifold_id)
	{
		// load model
		$this->load->model('imager');

		// create new door instance
		$oDoor = new Sliding_Door();
		$oDoor->load($bifold_id);

		// get the output
		$this->output
			->set_content_type('image/png')
			->set_output($this->imager->get_image($oDoor));
	}


	public function basket_image($bifold_id)
	{
		$this->load->model('bifold_imager');

		$bifold = $this->session->cart->get_product($bifold_id);

		$this->output->set_content_type('image/png')->set_output($this->bifold_imager->get_image($bifold));
	}

	public function order_image($bifold_id)
	{
		$this->load->model('bifold_imager');

		$bifold = new Bifold_Door();
		$bifold->load($bifold_id);

		$this->output->set_content_type('image/png')->set_output($this->bifold_imager->get_image($bifold));
	}

	public function basket_summary($bifold_id)
	{
		$data = array();

		$data['bifold'] = $this->session->cart->get_product($bifold_id);
		$data['basket_id'] = $bifold_id;
		$this->load->view('designer/bifold_summary', $data);
	}


	public function get_door_summary()
	{
		$this->session->current_bifold->update_from_array($this->input->post());

		$data = array();

		$data['door'] = $this->session->current_bifold;

		$this->load->view('designer/step2/summary.php', $data);
	}

	public function update_bifold()
	{
		$this->session->current_design->update_from_array($this->input->post());
	}

	public function get_price()
	{
		$bifold = new Bifold_Door();
		$bifold->update_from_array($this->input->post());

		$ret = array();

		$ret['formatted_price'] = number_format($bifold->get_total(), 2);

		$this->output->set_content_type('application/json')->set_output(json_encode($ret));

	}

	public function get_current_price()
	{
		$bifold = $this->session->current_design;
		
		$ret = array();

		$ret['formatted_price'] = number_format($bifold->get_total(), 2);
		$ret['breakdown'] = '';//$bifold->get_breakdown();

		$this->output->set_content_type('application/json')->set_output(json_encode($ret));
	}


	/*
	 * works out the price for the given configuration
	 */
	public function get_basic_price() 
	{
		$this->load->helper('quote');
		quote__get_basic_price();
	}


	/*
	 * gets the content of the email sent for a given bifold door id
	 */
	public function get_quote_email($id) 
	{
		if( $this->session->loggedin == true ) {
			$this->load->helper('quote');
			$sEmailHTML = quote__get_email_html($id);
			$this->output->set_output($sEmailHTML);
		}
	}

}