<?php
namespace content_a\product\thumb;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get(false, 'thumb')->ALL("/^product\/thumb\/([a-zA-Z0-9]+)$/");
		$this->post('thumb')->ALL("/^product\/thumb\/([a-zA-Z0-9]+)$/");
	}
}
?>