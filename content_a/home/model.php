<?php
namespace content_a\home;
use \lib\debug;
use \lib\utility;

class model extends \content_a\main\model
{
	public function getListStore()
	{
		$request = [];
		utility::set_request_array($request);
		return $this->get_list_store();
	}
}
?>