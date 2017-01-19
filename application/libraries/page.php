<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Page
{
	private $_page_title = NULL;
	private $_javascript = array();
	private $_css = array();

	public $slug = NULL;

	public function __construct()
	{
		$CI =& get_instance();

		$CI->config->load('page');

		foreach($CI->config->item('javascript_urls') as $javascript){
			$this->add_script($javascript);
		}

		foreach($CI->config->item('css_urls') as $css){
			$this->add_css($css);
		}
	}

	public function reset()
	{
		$this->_javascript = array();
		$this->_css = array();
	}

	public function page_title($fallback_title = NULL)
	{
		if(is_null($this->_page_title) AND is_null($fallback_title)){
			throw new Exception("Title not specified and fallback not available", 1);
		}

		if(is_null($this->_page_title)){
			return $fallback_title;
		}

		return $this->_page_title;
	}

	public function add_script($src, $attributes = array())
	{
		$defaults = array();
		$defaults['src'] = strpos($src, base_url()) === FALSE ? $src : "{$src}?" . time();
		$defaults['type'] = 'text/javascript';

		$this->_javascript[] = '<script ' . _parse_form_attributes($attributes, $defaults) . '></script>';
	}

	public function add_script_block($script, $attributes = array())
	{
		$defaults = array();
		$defaults['type'] = 'text/javascript';

		$this->_javascript[] = '<script ' . _parse_form_attributes($attributes, $defaults) . '>' . PHP_EOL . $script . PHP_EOL . '</script>';
	}

	public function add_css($href, $attributes = array())
	{
		$defaults = array();
		$defaults['href'] = strpos($href, base_url()) === FALSE ? $href : "{$href}?" . time();
		$defaults['type'] = 'text/css';
		$defaults['rel'] = 'stylesheet';

		$this->_css[] = '<link ' . _parse_form_attributes($attributes, $defaults) . '/>';
	}

	public function render_js()
	{
		$return = '';

		foreach ($this->_javascript as $script) {
			$return .= $script . PHP_EOL;
		}

		return $return;
	}

	public function render_css()
	{
		$return = '';

		foreach ($this->_css as $style) {
			$return .= $style . PHP_EOL;
		}

		return $return;
	}

	public function get_breadcrumbs()
	{
		return array();
	}
}

/* End of file page.php */
/* Location: ./application/libraries/page.php */
