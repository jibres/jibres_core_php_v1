<?php
namespace content_a\cats\property;


class model
{
	public static function post()
	{

		if(\dash\request::post('deletefile'))
		{
			\lib\app\product\cat::remove_file(\dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Category file deleted"));
				\dash\redirect::pwd();
			}
			return;
		}

		$args        = [];
		$args['cat'] = \dash\request::post('cat');
		$args['key'] = \dash\request::post('key');

		$result      = \lib\app\product\cat::property($args, \dash\request::get('id'), \dash\request::post('operation'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>