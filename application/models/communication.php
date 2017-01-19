<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Communication extends CI_Model {

	public function send_email($from_email, $from_name, $to, $subject, $content, $attachments = array())
	{
		$this->load->library('email');

		$this->email->from($from_email, $from_name);
		$this->email->to($to);
		$this->email->reply_to('enquiries@mybifold.co.uk');
		$this->email->bcc(array('bill@theconsultancy.co.uk', 'enquiries@mybifold.co.uk', 'woodsp@sternfenster.com'));
		$this->email->subject($subject);
		$this->email->message($content);

		foreach($attachments as $attach){
			$this->email->attach($attach);
		}

		$this->email->send();
	}

}

/* End of file communication.php */
/* Location: ./application/models/communication.php */
