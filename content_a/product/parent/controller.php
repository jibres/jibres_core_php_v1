<?php
namespace content_a\product\parent;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{


		$this->get(false, 'list')->ALL("/.*/");
	}
}
?>