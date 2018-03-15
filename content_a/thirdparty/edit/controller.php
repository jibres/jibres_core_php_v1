<?php
namespace content_a\thirdparty\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(\lib\request::get('id'))
		{
			$this->redirector(\lib\url::here(). '/thirdparty/edit/general?id='.\lib\request::get('id'))->redirect();
		}
		else
		{
			$this->redirector(\lib\url::here(). '/thirdparty')->redirect();
		}

		// \lib\error::page(T_("Invalid url"));
	}
}
?>
