<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {

	private
		// simple login details for this page
		$_username = 'agsuser'
	,	$_password = 'Acc3essAG5'
	;

	public function __construct()
	{
		parent::__construct();

		$this->page->add_css(base_url('assets/css/admin.css'));
		$this->page->add_script(base_url('assets/js/admin.js'));
	}

	public function index()
	{

		// check if we are trying to log in
		if( isset($_POST) ) {
			if( $this->input->post('username') == $this->_username && $this->input->post('password') == $this->_password ) {
				$this->session->loggedin = true;
			}
		}

		// check if the user is logged in or not
		if( $this->session->loggedin ) {
			// load the initial admin page
			redirect('/admin/quotes/?'. SID, 'refresh');
		} else {
			// show the login view
			$this->load->view('admin/login');
		}

	}

	public function quotes()
	{
		// check if the user is logged in or not
		if( $this->session->loggedin != true ) {
			redirect('/admin', 'refresh');
		}

		// get the bifold door records
		$oDoor = new Sliding_Door();
		$data['orders'] = $oDoor->get_latest_orders();

		// load the view
		$this->load->view('admin/bifold_door_records', $data);
	}

	public function logout()
	{
		unset($this->session->loggedin);
		$this->session->loggedin = null;
		redirect('/admin/quotes', 'refresh');
	}
}