<?php
namespace content_a\product\edit\delete;


class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get(false, 'delete')->ALL("/^product\/edit\/delete\/([a-zA-Z0-9]+)$/");
		$this->post('delete')->ALL("/^product\/edit\/delete\/([a-zA-Z0-9]+)$/");
	}
}
?>
