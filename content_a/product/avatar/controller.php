<?php
namespace content_a\product\avatar;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{


		$this->get(false, 'avatar')->ALL("/.*/");
		$this->post('avatar')->ALL("/.*/");
	}
}
?>