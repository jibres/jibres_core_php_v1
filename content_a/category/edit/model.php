<?php
namespace content_a\category\edit;


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

		$args               = [];
		$args['title']     = \dash\request::post('title');
		$args['desc']      = \dash\request::post('desc');


		$result = \lib\app\product\category::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>