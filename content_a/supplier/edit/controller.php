<?php
namespace content_a\supplier\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(\lib\utility::get('id'))
		{
			$this->redirector($this->url('baseFull'). '/supplier/edit/general?id='.\lib\utility::get('id'))->redirect();
		}
		else
		{
			$this->redirector($this->url('baseFull'). '/supplier')->redirect();
		}

		// \lib\error::page(T_("Invalid url"));
	}
}
?>
