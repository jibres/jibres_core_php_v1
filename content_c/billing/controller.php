<?php
namespace content_c\billing;

class controller extends  \content_c\main\controller
{

	public function ready()
	{

		$this->get("billing", "billing")->ALL();
		$this->post("billing")->ALL();

		$url = \lib\router::get_url();
		if(preg_match("/^billing\/invoice\/\d+$/", $url))
		{
			\lib\router::set_controller('\\content_c\\billing\\invoice');
			return;
		}
	}
}
?>