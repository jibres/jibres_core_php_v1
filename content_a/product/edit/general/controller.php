<?php
namespace content_a\product\edit\general;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->get(false, 'general')->ALL("/^product\/edit\/general\/([a-zA-Z0-9]+)$/");
		$this->post('general')->ALL("/^product\/edit\/general\/([a-zA-Z0-9]+)$/");
	}
}
?>
