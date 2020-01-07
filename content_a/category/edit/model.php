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
		$args['isdefault'] = \dash\request::post('isdefault');
		$args['site']      = \dash\request::post('site');
		$args['valuetype'] = \dash\request::post('valuetype');
		$args['maxsale']   = \dash\request::post('maxsale');
		$args['title']     = \dash\request::post('title');
		$args['desc']      = \dash\request::post('desc');


		$result = \lib\app\product\cat::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Category successfully updated"));
			\dash\redirect::pwd();
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>