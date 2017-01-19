<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Model {

	private $_session_var = NULL;

	/**
	 * will start session handler and init variables if they don't exist
	 */
	public function __construct()
	{
		session_start();
		$this->_session_var = 'MYBIFOLD_SESSION_' . filemtime(__FILE__);

		if(empty($_SESSION[$this->_session_var]['SessionActive'])){
			$this->create_session();
		}
	}

	/**
	 * Setup a new session / initialise or reset all cart
	 */
	public function create_session(){
		$_SESSION[$this->_session_var]['SessionActive'] = TRUE;
//		$_SESSION[$this->_session_var]['User'] = new User();
		$_SESSION[$this->_session_var]['Data'] = array();
		$_SESSION[$this->_session_var]['Flash'] = array();
		$_SESSION[$this->_session_var]['Cart'] = new Cart();
		// $this->current_bifold = new Bifold_Door();
		$this->current_design = new Sliding_Door();
	}

	/**
	 * Logout user - this will clear shopping cart and logout the user.
	 */
	public function logout()
	{
		$this->create_session();
	}

	/**
	 * Required to output data for codeigniter profiler.
	 *
	 * @return array Array of all session data to output in profiler log.
	 */
	public function userdata()
	{
		return $_SESSION[$this->_session_var];
	}

	/**
	 * Add a message that will be shown to user on next possible page view.
	 * @param string $data  The string to show the user
	 * @param string $level level - usually used on output to set a class
	 */
	public function set_flash_data($data, $level = 'info')
	{
		$_SESSION[$this->_session_var]['Flash'][] = array('level'=>$level, 'data'=>$data);
	}

	/**
	 * Get the array of flash messages, empty the array when retrieved.
	 * @return array array of all messages [may be empty]
	 */
	public function get_flash_data()
	{
		$ret = $_SESSION[$this->_session_var]['Flash'];

		$_SESSION[$this->_session_var]['Flash'] = array();

		return $ret;
	}

	/**
	 * Retrieve user data from session
	 * @param  string $key key to retrieve e.g. Session->userdata
	 * @return mixed  return the value if it exists
	 */
	public function __get($key)
	{
		if($key == 'cart'){
			return $_SESSION[$this->_session_var]['Cart'];
		}

		return array_key_exists($key, $_SESSION[$this->_session_var]['Data']) ? $_SESSION[$this->_session_var]['Data'][$key] : FALSE;
	}

	/**
	 * Set user data in session
	 * @param string $key   key to set e.g. Session->userdata = 'test'
	 * @param mixed $value value to store
	 */
	public function __set($key, $value)
	{
		return $_SESSION[$this->_session_var]['Data'][$key] = $value;
	}

}

/* End of file  */
/* Location: ./application/models/ */