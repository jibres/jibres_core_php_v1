<?php
namespace content_a\product;


class model extends \content_a\main\model
{

	public function list_product($_args)
	{
		$this->user_id = $this->login('id');
		$request       = [];
		$request['id'] = isset($_args['id']) ? $_args['id'] : null;
		\lib\utility::set_request_array($request);
		$result =  $this->get_list_product();
		return $result;
	}


	public function edit($_team, $_product)
	{
		$this->user_id    = $this->login('id');
		$request          = [];
		$request['team']  = $_team;
		$request['id']    = $_product;
		\lib\utility::set_request_array($request);
		$result           =  $this->get_product();
		return $result;
	}
}
?>