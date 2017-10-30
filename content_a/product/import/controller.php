<?php
namespace content_a\product\import;

class controller extends \content_a\main\controller
{
	/**
	 * rout
	 */
	public function ready()
	{
		$this->get(false, 'import')->ALL();
		$this->post('import')->ALL();
	}
}
?>