<?php
namespace content_a\thirdparty\billing;


class model
{
	public static function post()
	{
		\lib\app\thirdparty::edit(self::getPost(), \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
