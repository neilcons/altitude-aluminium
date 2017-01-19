<?php

class Test_Bifold_Door_Price{

	public $bifold;

	public function __get($key)
	{
		if($key == 'min'){
			return $this->expected-1;
		}
		if($key == 'max'){
			return $this->expected+1;
		}
		if($key == 'ref'){
			if(file_exists(BASEPATH . "../assets/images/tests/bifold_door/{$this->test_id}.png")){
				return '<img src="' . base_url("/assets/images/tests/bifold_door/{$this->test_id}.png") . '" class="img-responsive" />';
			}
			return "Is {$this->actual} between {$this->min} and {$this->max}?";
		}

		if($key == 'notes'){
			return "Expected: {$this->expected}, Actual: {$this->actual}, Difference: &pound;" . number_format($this->actual - $this->expected, 2);
		}
	}

}