<?php
namespace content_a\thirdparty\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(\lib\utility::get('id'))
		{
			$this->redirector($this->url('baseFull'). '/thirdparty/edit/general?id='.\lib\utility::get('id'))->redirect();
		}
		else
		{
			$this->redirector($this->url('baseFull'). '/thirdparty')->redirect();
		}

		// \lib\error::page(T_("Invalid url"));
	}
}
?>
