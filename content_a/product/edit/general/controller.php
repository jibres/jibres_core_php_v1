<?php
namespace content_a\product\edit\general;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$product_id = \lib\utility::get('id');
		if(!$product_id)
		{
			\lib\error::page();
		}

		$this->get()->ALL();
		$this->post('general')->ALL("/^product\/edit\/general\/([a-zA-Z0-9]+)$/");
	}
}
?>
