<?php
namespace content_a\product\edit\thumb;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get(false, 'thumb')->ALL("/^product\/edit\/thumb\/([a-zA-Z0-9]+)$/");
		$this->post('thumb')->ALL("/^product\/edit\/thumb\/([a-zA-Z0-9]+)$/");
	}
}
?>
