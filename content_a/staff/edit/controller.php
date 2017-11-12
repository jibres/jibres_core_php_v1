<?php
namespace content_a\staff\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		$this->redirector($this->url('baseFull'). '/staff/edit/general?id='.\lib\utility::get('id'))->redirect();
		return;

		\lib\error::page(T_("Invalid url"));
	}
}
?>
