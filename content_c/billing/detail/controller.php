<?php
namespace content_c\billing\detail;

class controller extends  \content_c\main\controller
{

	public function ready()
	{


		$this->get("detail", "detail")->ALL("/^billing\/detail$/");

		$this->post("detail")->ALL("/^billing\/detail$/");
	}
}
?>