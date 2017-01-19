<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help_Controller extends CI_Controller {

	public function bifold_size()
	{
		$this->load->view('help/bifold_size');
	}

	public function opening()
	{
		$this->load->view('help/opening_direction');
	}

	public function configurations()
	{
		$this->load->view('help/configurations');
	}

	public function colours()
	{
		$this->load->view('help/colours');
	}

	public function hardware()
	{
		$this->load->view('help/hardware');
	}

	public function glass()
	{
		$this->load->view('help/glass');
	}

	public function extras()
	{
		$this->load->view('help/extras');
	}

	public function technical()
	{
		$this->load->view('help/technical');
	}

}
/* End of file pricing_controller.php */
/* Location: ./application/controllers/pricing_controller.php */