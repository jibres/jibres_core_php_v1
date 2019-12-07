<?php
namespace content_a\setting\logo;


class model
{
	public static function post()
	{
		$result = null;

		\lib\app\setting\setup::upload_logo();

		if(\dash\engine\process::status())
		{
			\lib\store::refresh();
			\dash\redirect::pwd();
		}
	}
}
?>