<?php

function my_empty($value)
{
	return empty($value);
}

function is_negative($value)
{
	return in_array(strtolower($value), array('no', 'none'));
}

function is_unsure($value)
{
	return in_array(strtolower($value), array('don\'t know'));
}


	function show_flash_messages()
	{
		$CI =& get_instance();

		$data = $CI->session->get_flash_data();

		$html = '';

		foreach($data as $flash_msg){
			$html .= $CI->load->view('blocks/alert', $flash_msg, TRUE);
		}

		return $html;
	}



	function validation_errors_to_flash_data()
	{
		$CI =& get_instance();
		
		$delim = '@~@~@~@~@~@~@~@~@~@~';

		$error_list = validation_errors($delim);

		$errors = explode($delim, $error_list);

		foreach($errors as $error){
			if(!empty($error)){
				$CI->session->set_flash_data($error, 'warning');
			}
		}

	}

function make_slug($string)
{
	return str_replace(array(' ', '/', '(', ')'), '-', MB_ENABLED ? mb_strtolower($string) : strtolower($string));
}
