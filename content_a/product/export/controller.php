<?php
namespace content_a\product\export;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->post('export')->ALL();
	}
}
?>
