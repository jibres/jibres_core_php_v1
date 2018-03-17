<?php
namespace content_a\thirdparty\edit;


class controller extends \content_a\main\controller
{
	public function ready()
	{
		if(\lib\request::get('id'))
		{
			\lib\redirect::to(\lib\url::here(). '/thirdparty/edit/general?id='.\lib\request::get('id'));
		}
		else
		{
			\lib\redirect::to(\lib\url::here(). '/thirdparty');
		}

		// \lib\error::page(T_("Invalid url"));
	}
}
?>
