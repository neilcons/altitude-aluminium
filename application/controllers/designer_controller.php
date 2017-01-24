<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Designer_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->page->add_css(base_url('assets/css/designer.css'));
		$this->page->add_script(base_url('assets/js/designer.js'));

		// define database constant records
		$this->constants->define_constants();
	}

	/*
	 * homepage of the designer
	 */
	public function index() // optional Splash page
	{
		$this->create();
	}

	/*
	 * draw the designer
	 */
	public function create()
	{
		// $this->load->model('constants');
		$this->page->add_css(base_url('lib/radio/style.css'));

		// array to hold all data to pass to the view
		$aData = array();

		// create new door instance
		$this->session->current_design = new Sliding_Door();
		$oBifoldModel = new Sliding_Door();

		// get the min and max widths and heights
		$aData['minmax'] = $oBifoldModel->get_min_max_widths_and_heights();

		// load the bifold hardware colour model
		$oBifoldHardwareColourModel = new Bifold_Hardware_Colour(); 

		// get the colours for the traffic handle
		$aTrafficColours = $oBifoldHardwareColourModel->get_hardware_colours_by_hardware_name('Handle');

		// get the colours for the slave handle
		$aSlaveColours = $oBifoldHardwareColourModel->get_hardware_colours_by_hardware_name('Slave');

		// get the sliding door handle
		$aSlidingDoorColours = $oBifoldHardwareColourModel->get_hardware_colours_by_hardware_name('Sliding Door Handle');

		// get the cills
		$this->load->model('Bifold_Cill');
		$aCills = $this->Bifold_Cill->get_cills();

		// get the thresholds
		$this->load->model('Bifold_Threshold');
		$aThresholds = $this->Bifold_Threshold->get_thresholds();


		/*
		 * set data to pass through to the view
		 */

		// set the colours to pass to view
		$aData['trafficcolours'] = $aTrafficColours;
		$aData['slavecolours'] = $aSlaveColours;
		$aData['slidingdoorcolours'] = $aSlidingDoorColours;

		// cills
		$aData['cills'] = $aCills;

		// thresholds
		$aData['thresholds'] = $aThresholds;

		// put the bifold object in the array for the vie
		$aData['door'] = new Sliding_Door();

		// set the hidden fields
		$aData['hidden_fields'] = array
		(
			'opening'					=> $aData['door']->opening
		,	'bifold_scheme_id'			=> $aData['door']->bifold_scheme_id
		// ,	'sliding_direction'			=> $aData['door']->sliding_direction
		,	'display_sliding_direction'	=> $aData['door']->sliding_direction
		);

		// set sliding direction
		// $aData['display_sliding_direction'] = $aData['door']->sliding_direction;

		// load the view
		$this->load->view('designer/designer', $aData);
	}

	/*
	 * draws the designer summary and customer details form
	 */
	public function step2()
	{
		if(!$post = $this->input->post()) { // We must have post data.
			redirect('designer/create?' . SID);
		}

		exit('submitted');

		$this->page->add_script(base_url('assets/js/step2.js'));
		$this->page->add_css(base_url('lib/radio/style.css'));
		$this->load->model('bifold_designer_interface');

		$this->page->add_css(base_url('lib/owl-carousel/owl.carousel.css'));
		$this->page->add_script(base_url('lib/owl-carousel/owl.carousel.min.js'));

		$data = array();

		$data['bifold'] = new Bifold_Door();
		$data['bifold']->update_from_array($this->input->post());

		$data['hidden'] = $data['bifold']->get_hidden_fields('step2');

		// $this->session->current_bifold = $data['bifold'];
		$this->session->current_design = $data['bifold'];

		$this->load->view('designer/step2', $data);
	}

	public function make_enquiry()
	{
		$data = array();
		$this->page->add_css(base_url('lib/radio/style.css'));

		// $data['door'] = $this->session->current_bifold;
		$data['door'] = $this->session->current_design;

		$this->load->view('designer/step3', $data);
	}

	public function enquiry()
	{
		$to = $this->input->post('your_email');

		$this->load->library('email');

		$this->email->from("noreply@echodigitalmedia.co.uk", "Prestige Bifolds");
		$this->email->to($to);
		$this->email->cc('enquiries@prestigebifolds.co.uk');
		$this->email->reply_to('enquiries@prestigebifolds.co.uk');
		$this->email->subject("Your Prestige Bifold");
		// $this->session->current_bifold->update_from_array($this->input->post());
		$this->session->current_design->update_from_array($this->input->post());
		$data = array();
		// $this->session->current_bifold->save();
		$this->session->current_design->save();
		// $data['bifold'] = $this->session->current_bifold;
		$data['bifold'] = $this->session->current_design;
		$this->email->message($this->load->view('email/bifold', $data, TRUE));
		$this->email->send();

		$this->load->view('enquiry/thanks');
	}

	public function basket_delete($basket_index)
	{
		$this->session->cart->delete_by_id($basket_index);
		redirect('designer/summary?' . SID);
	}

	public function add_to_cart()
	{
		// $this->session->cart->add_product($this->session->current_bifold);
		$this->session->cart->add_product($this->session->current_design);
		redirect('designer/summary?' . SID);
	}

	public function summary()
	{
		if($this->session->cart->get_count() == 0){
			redirect('designer?' . SID);
		}

		$this->page->add_script(base_url('assets/js/summary.js'));

		$data['products'] = $this->session->cart->get_active_products();

		$this->load->view('designer/summary', $data);
	}

	public function delivery()
	{
		$this->page->add_script(base_url('assets/js/delivery.js'));
		$this->page->add_css(base_url('lib/radio/style.css'));
		$this->load->view('designer/delivery');
	}

	public function external_colour_popup()
	{
		$data = array();
		// $data['bifold'] = $this->session->current_bifold;
		$data['bifold'] = $this->session->current_design;
		// $data['colour_ranges'] = $this->db->order_by('order')->get_where('colour_range', array('id'=>3))->result('Colour_Range');
        $data['colour_ranges'] = $this->db->order_by('order')->get('colour_range')->result('Colour_Range');
		$this->load->view('designer/step2/external_colours', $data);
	}

	public function internal_colour_popup()
	{
		$data = array();
		// $data['bifold'] = $this->session->current_bifold;
		$data['bifold'] = $this->session->current_design;
		$data['colour_ranges'] = $this->db->order_by('order')->get('colour_range')->result('Colour_Range');
		$this->load->view('designer/step2/internal_colours', $data);
	}

	public function send_email()
	{
		$this->load->library('form_validation');


		if ($this->form_validation->run() == FALSE){

			$this->page->add_script(base_url('assets/js/delivery.js'));
			$this->page->add_css(base_url('lib/radio/style.css'));
			$this->load->view('designer/delivery', $this->input->post());

		} else {

			$this->load->model('communication');
			$order = new Order();

			$order->update_from_array($this->input->post());

			foreach($this->session->cart->get_active_products() as $product){
				$order->add_product($product);
			}

			$order->save();

			$data = array();

			$data['order'] = $order;

			$email_content = $this->load->view('email/bifold', $data, TRUE);

			$this->communication->send_email('info@mybifold-configurator.co.uk', 'My Bifold', $order->email_address, 'Your MyBifold Quote #' . $order->id, $email_content);

			$this->session->create_session();

			$this->load->view('success');
		}
	}

}

/* End of file pricing_controller.php */
/* Location: ./application/controllers/pricing_controller.php */