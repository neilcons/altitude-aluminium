<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_Bifold_Prices extends CI_Model {

	public function get_price_tests()
		{
			$this->load->model('bifold_pricer');
			$tests = array();

			$test_id = 1;

			$test = new Test_Bifold_Door_Price();
			$test->test_id = $test_id++;
			$test->expected = 2219;
			$bifold = new Bifold_Door();
			$bifold->width = 1000;
			$bifold->height = 2000;
			$test->actual = $this->bifold_pricer->get_price($bifold);
			$test->notes = $this->load->view('test/bifold_door/price_breakdown', array('bifold'=>$bifold), TRUE);
			$test->bifold = $bifold;
			$tests[] = $test;

			$test = new Test_Bifold_Door_Price();
			$test->test_id = $test_id++;
			$test->expected = 2531;
			$bifold = new Bifold_Door();
			$bifold->width = 2100;
			$bifold->height = 2200;
			$test->actual = $this->bifold_pricer->get_price($bifold);
			$test->notes = $this->load->view('test/bifold_door/price_breakdown', array('bifold'=>$bifold), TRUE);
			$test->bifold = $bifold;
			$tests[] = $test;

			$test = new Test_Bifold_Door_Price();
			$test->test_id = $test_id++;
			$test->expected = 2597;
			$bifold = new Bifold_Door();
			$bifold->width = 2400;
			$bifold->height = 2400;
			$test->actual = $this->bifold_pricer->get_price($bifold);
			$test->notes = $this->load->view('test/bifold_door/price_breakdown', array('bifold'=>$bifold), TRUE);
			$test->bifold = $bifold;
			$tests[] = $test;


			$test = new Test_Bifold_Door_Price();
			$test->test_id = $test_id++;
			$test->expected = 5152;
			$bifold = new Bifold_Door();
			$bifold->width = 4500;
			$bifold->height = 2200;
			$bifold->bifold_scheme_id = 12;
			$test->actual = $this->bifold_pricer->get_price($bifold);
			$test->notes = $this->load->view('test/bifold_door/price_breakdown', array('bifold'=>$bifold), TRUE);
			$test->bifold = $bifold;
			$tests[] = $test;

			$test = new Test_Bifold_Door_Price();
			$test->test_id = $test_id++;
			$test->expected = 4257;
			$bifold = new Bifold_Door();
			$bifold->width = 4500;
			$bifold->height = 2000;
			$bifold->bifold_scheme_id = 7;
			$test->actual = $this->bifold_pricer->get_price($bifold);
			$test->notes = $this->load->view('test/bifold_door/price_breakdown', array('bifold'=>$bifold), TRUE);
			$test->bifold = $bifold;
			$tests[] = $test;

			return $tests;
		}	

}

/* End of file test_window_prices.php */
/* Location: ./application/models/test_window_prices.php */