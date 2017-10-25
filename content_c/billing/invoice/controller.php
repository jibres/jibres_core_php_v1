<?php
namespace content_c\billing\invoice;

class controller extends  \content_c\main\controller
{

	public function ready()
	{


		$this->get("invoice", "invoice")->ALL("/^billing\/invoice\/(\d+)$/");

		$this->post("invoice")->ALL("/^billing\/invoice\/(\d+)$/");
	}
}
?>