<?php
namespace content_a\product\delete;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get(false, 'delete')->ALL("/^product\/delete\/([a-zA-Z0-9]+)$/");
		$this->post('delete')->ALL("/^product\/delete\/([a-zA-Z0-9]+)$/");
	}
}
?>