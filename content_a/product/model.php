<?php
namespace content_a\product;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
{

	/**
	 * Gets the list.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function list_product($_args)
	{
		$this->user_id = $this->login('id');
		$request       = [];
		$request['id'] = isset($_args['id']) ? $_args['id'] : null;
		utility::set_request_array($request);
		$result =  $this->get_list_product();
		return $result;
	}


	/**
	 * ready to edit product
	 * load data
	 *
	 * @param      <type>  $_team    The team
	 * @param      <type>  $_product  The product
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public function edit($_team, $_product)
	{
		$this->user_id    = $this->login('id');
		$request          = [];
		$request['team']  = $_team;
		$request['id']    = $_product;
		utility::set_request_array($request);
		$result           =  $this->get_product();
		return $result;
	}

}
?>