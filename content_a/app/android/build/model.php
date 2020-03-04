<?php
namespace content_a\app\android\build;

class model
{
	public static function post()
	{
		\lib\app\application\queue::set_android();

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
		else
		{
			\dash\redirect::pwd();
		}
	}
}
?>
