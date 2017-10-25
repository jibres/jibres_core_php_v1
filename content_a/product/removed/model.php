<?php
namespace content_a\product\removed;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\model
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
		$request['status'] = 'suspended';
		$request['id'] = isset($_args['id']) ? $_args['id'] : null;
		utility::set_request_array($request);
		$result =  $this->get_list_product();

		return $result;
	}
}
?>