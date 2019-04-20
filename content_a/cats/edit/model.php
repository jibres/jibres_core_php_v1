<?php
namespace content_a\cats\edit;


class model
{
	public static function post()
	{
		$args               = [];
		$args['isdefault'] = \dash\request::post('isdefault');
		$args['site']       = \dash\request::post('site');
		$args['valuetype']  = \dash\request::post('valuetype');
		$args['maxsale']    = \dash\request::post('maxsale');
		$args['title']        = \dash\request::post('title');

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