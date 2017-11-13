<?php
namespace content_a\staff\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(\lib\utility::get('id'))
		{
			$this->redirector($this->url('baseFull'). '/staff/edit/general?id='.\lib\utility::get('id'))->redirect();
		}
		else
		{
			$this->redirector($this->url('baseFull'). '/staff')->redirect();
		}

		// \lib\error::page(T_("Invalid url"));
	}
}
?>
