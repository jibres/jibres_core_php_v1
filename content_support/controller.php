<?php
namespace content_support;

class controller
{

	public static function routing()
	{
		if(\dash\engine\store::inStore())
		{
			\dash\redirect::to(\lib\store::url(). '/ticket');
		}
		else
		{
			\dash\redirect::to(\dash\url::kingdom(). '/my/ticket');
		}
	}
}
?>