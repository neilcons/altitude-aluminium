<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quote_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page->add_css(base_url('assets/css/designer.css'));
		$this->page->add_script(base_url('assets/js/designer.js'));

		// define database constant records
		$this->constants->define_constants();
	}

	/*
	 * quote page - draws design summary and the customer data collection fields
	 */
	public function index()
	{
		if(!$post = $this->input->post()) { // We must have post data.
			redirect('designer/create?' . SID);
		}

		// set data var
		$data = array();

		// assign and update the selected door and options
		$oDoor = new Sliding_Door();
		$oDoor->update_from_array($this->input->post());

		// store updated bifold session
		$this->session->current_design = $oDoor;

		// hard set the energy effiicent value based on the triple glazing option
		if( $oDoor->triple_glazing == 1 ) {
			$oDoor->energy_efficient = 1;
			$oDoor->update_from_array($oDoor);
		}

		// get the frame colours
		$this->load->library('colour');
		$oColourModel = new Colour();
		$oExternalColour = $oColourModel->get_colour_by_id($oDoor->external_colour_id);
		$oInternalColour = $oColourModel->get_colour_by_id($oDoor->internal_colour_id);

		// set the frame colour rals
		$data['external_ral'] = $oExternalColour->RAL;
		$data['internal_ral'] = $oInternalColour->RAL;

		// store current bifold in array for view
		$data['door'] = $oDoor;

		// get the image
		$this->load->model('imager');
		$oImage = $this->imager->get_image($oDoor);
		$data['base64_image'] = base64_encode($oImage);

		// do we need to display the external handle data
		$aConfiguration = explode('-', $oDoor->configuration);

		// set alternative glazing type
		$data['glazing_type'] = $this->input->post('triple_glazing') == 1 ? 'Triple Glazed' : 'Double Glazed';

		// load the quote helper
		$this->load->helper('quote');
		$data['price'] = quote__get_basic_price('price');

		// load the view
		$this->load->view('designer/quote', $data);
	}

	public function submit()
	{
		// view data storage array
		$data = array(
			'aa_telephone_number'		=> ''
		,	'aa_email_address'			=> SITE_EMAIL_ADDRESS
		,	'aa_freephone_telephone'	=> ''
		,	'aa_footer_copyright'		=> '&copy; '. Date('Y') .' Altitude Aluminium, all rights reserved.'
		);

		// set the url to use for images in the email
		$data['image_url'] = 'http://dev.beta.echodigitalmedia.co.uk/aa/';

		// load the quote helper and get the basic price minus vat and unformatted
		$this->load->helper('quote');
		$dBasicPrice = quote__get_basic_price('price', false, false);
		$dVat = $dBasicPrice * 0.2;
		$dTotalPrice = $dBasicPrice * 1.2;

		// get the bifold
		$oSessionDesign = $this->session->current_design;

		// update bifold data with input
		$oSessionDesign->update_from_array($this->input->post());

		// set the initial quote price data
		$oSessionDesign->quote_price = $dBasicPrice;
		$oSessionDesign->quote_price_with_vat = $dTotalPrice;

		// set the correct slide direction
		// $oSessionDesign->slide_left = $oSessionDesign->sliding_direction == 'left' ? 1 : 0;

		// save the bifold door record
		$oSessionDesign->save();

		// get true image width - damn IE!
		$iDoor_Id = $oSessionDesign->id;
		$sImageURL = base_url() .'index.php/ajax/image/'. $iDoor_Id;

		$sImageString = file_get_contents($sImageURL);
		$oImage = imagecreatefromstring($sImageString);

		// prepare final price and pass to the view
		$data['quote_price'] = number_format($dBasicPrice, 2);
		$data['quote_vat'] = number_format($dVat, 2);
		$data['quote_total'] = number_format($dTotalPrice, 2);

		// set image data for view
		$data['image_source'] = $sImageURL;
		$data['image_width'] =  imagesx($oImage);

		// get the frame colours
		$this->load->library('colour');
		$oColourModel = new Colour();
		$oExternalColour = $oColourModel->get_colour_by_id($oSessionDesign->external_colour_id);
		$oInternalColour = $oColourModel->get_colour_by_id($oSessionDesign->internal_colour_id);

		// set the frame colour rals
		$data['external_ral'] = $oExternalColour->RAL;
		$data['internal_ral'] = $oInternalColour->RAL;

		// load the email library
		$this->load->library('email');

		// prepare email options
		$to = $this->input->post('your_email');
		$this->email->from(SITE_EMAIL_ADDRESS, "Altitude Aluminium");
		$this->email->to($to);
		// $this->email->cc('noreply@echodigitalmedia.co.uk');
		// $this->email->reply_to(SITE_EMAIL_ADDRESS);
		// $this->email->bcc(SITE_EMAIL_ADDRESS);
		$this->email->subject("Your Altitude Aluminium Slide Door Quote #". str_pad($iDoor_Id, 7, '0', STR_PAD_LEFT));

		// assign the bifold to the view
		// $data['bifold'] = $oSessionBifold;
		$data['door'] = $oSessionDesign;

		// explode the name and get the first part
		// $aName = explode(' ', $oSessionBifold->your_name);
		$aName = explode(' ', $oSessionDesign->your_name);
		$data['first_name'] = is_array($aName) && count($aName) > 1 ? $aName[0] : $oSessionDesign->your_name;

		// set alternative glazing type
		$data['glazing_type'] = $oSessionDesign->triple_glazing == 1 ? 'Triple Glazed' : 'Double Glazed';

		// set the full supply type description
		$data['supply_type'] = $oSessionDesign->supply_type == 'supply' ? 'Supply Only' : 'Supply &amp; Install';

		// prepare the content of the email
		$sEmailHTML = $this->load->view('email/template', $data, TRUE);

		// set the content of the email and send it
		$this->email->message($sEmailHTML);
		$this->email->send();

		// redirect to the thank you page
		redirect('quote/thanks/'. $iDoor_Id);
	}

	/*
	 * show the thank you page and kill the session
	 */
	public function thanks($id)
	{
		$data['image_id'] = $id;
		$this->load->view('designer/thanks', $data);
	}

}