<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Database_Table_Object
{
	protected $_table_name = 'order';

	private $_products = array();

	public function save($table_name = NULL)
	{
		parent::save($table_name);

		foreach($this->get_products() as $product){
			$product->order_id = $this->id;
			$product->save();
		}
	}

	public function reference()
	{
		return str_pad($this->_id, 7, '0', STR_PAD_LEFT);
	}

	public function add_product($product)
	{
		$this->_products[] = $product;
	}

	public function get_products()
	{
		return $this->_products;
	}

	public function __get($key)
	{
		if($key === 'date'){
			return new DateTime($this->_date['date']);
		}

		return parent::__get($key);
	}
}

/* End of file casement_window.php */
/* Location: ./application/libraries/casement_window.php */