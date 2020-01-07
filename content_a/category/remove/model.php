<?php
namespace content_a\category\remove;


class model
{
	public static function post()
	{
		$args              = [];
		$args['deletecat'] = \dash\request::post('deletecat');
		$args['whattodo']  = \dash\request::post('whattodo');
		$args['cat']       = \dash\request::post('cat');

		$result = \lib\app\product\cat::remove($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Category successfully deleted"));
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>