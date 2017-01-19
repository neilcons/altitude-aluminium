<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bifold_Price_Row
{

	public function __construct()
	{
		$this->qty = 0;
		$this->description = '<no description>';
		$this->price = 0;
		$this->discount = 0;
	}

	public function __get($key)
	{
		if($key == 'total'){
			return ($this->price * ((100 - $this->discount) / 100)) * $this->qty;
		}
	}

}

/* End of file casement_window.php */
/* Location: ./application/models/casement_window.php */