<?php
namespace content_a\product\import;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('import')->ALL();
	}
}
?>
