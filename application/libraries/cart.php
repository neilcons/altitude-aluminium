<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart
{
	private $_products;
	private $_index;
	private $_job_reference;
	private $_user = NULL;
	private $_id = NULL;

	public function mark_as_ordered_and_reset()
	{
		foreach($this->get_all_products() as $key=>$product){
 			if(!$product->is_deleted()){
				unset($this->_products[$key]);
 			}
 		}

 		$this->save_job();
 		$this->set_job_reference();
	}

	public function load_job($job_id)
	{
		$CI =& get_instance();
		$row = $CI->db->get_where('user_job', array('id'=>$job_id));

		if($row->num_rows() !== 1){
			throw new Exception("Not Found/Unique :: Table [user_job], Col [id], Value [{$job_id}]", 1);
		}

		$row = $row->row();

		$this->set_job_reference($row->reference);
		$this->_id = $job_id;

		$products = $CI->db->get_where('casement_window', array('job_id'=>$job_id))->result();
		$this->_index = 0;
		$this->_products = array();
		foreach($products as $product){
			$window = new Casement_Window();
			$window->load($product->id);
			$this->_products[$window->job_reference] = $window;
			$this->_index = max($this->_index, $window->job_reference);
		}
		$this->_index++;
	}

	public function save_job()
	{
		$delete_job = FALSE;
		$data = array();

		$data['user_id'] = $this->_user->id;
		$data['reference'] = $this->get_job_reference();

		$CI =& get_instance();

		if(count($this->get_active_products()) > 0){
			if(is_null($this->_id)){
				$CI->db->insert('user_job', $data);
				$this->_id = $CI->db->insert_id();
			} else {
				$CI->db->update('user_job', $data, array('id'=>$this->_id));
	 		}
		} else {
			if(!is_null($this->_id)){
				$CI->db->delete('user_job', array('id'=>$this->_id));
				$delete_job = TRUE;
	 		}
		}

 		foreach($this->get_all_products() as $key=>$product){
 			$product->job_id = $this->_id;
 			$product->save();
 			if($product->is_deleted()){
				unset($this->_products[$key]);
 			}
 		}

 		if($delete_job){
 			$this->_id = NULL;
 		}
	}

	public function set_user_by_reference(&$user)
	{
		$this->_user = $user;
	}

	public function set_user($user)
	{
		$this->_user = $user;
	}

	public function get_user()
	{
		return $this->_user;
	}

	public function get_job_reference()
	{
		return empty($this->_job_reference) ? NULL : $this->_job_reference;
	}

	public function set_job_reference($reference = '')
	{
		$this->_job_reference = $reference;
		if(empty($reference)){
			$this->_id = NULL;
		}
	}

	public function get_total()
	{
		$total = 0;

		foreach($this->get_active_products() as $product){

			$total += $product->get_total();

		}

		return $total;
	}

	public function __construct()
	{
		$this->_products = array();
		$this->_index = 1001;
	}

	public function add_product($product)
	{
		$this->_products[$this->_index] = $product;
		$product->job_reference = $this->_index;
		$product->quantity = 1;
		return $this->_index++;
	}

	public function get_product($basket_index)
	{
		return $this->_products[$basket_index];
	}

	public function get_all_products()
	{
		return $this->_products;
	}

	public function get_active_products()
	{
		$active_products = array();

		foreach($this->_products as $key=>$product){
			if(!$product->is_deleted()){
				$active_products[$key] = $product;
			}
		}

		return $active_products;
	}

	public function delete_by_id($basket_index)
	{
		$this->_products[$basket_index]->delete();
	}

	public function empty_cart()
	{
		foreach ($this->_products as $key => $product) {
			$product->delete();
		}
	}

	public function get_count()
	{
		return count($this->get_active_products());
	}
}

/* End of file cart.php */
/* Location: ./application/libraries/cart.php */
