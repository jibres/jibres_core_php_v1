<?php
namespace content_a\setting\shipping\method;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\setting\shipping_method::remove(\dash\request::post('title'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Package removed"));
				\dash\redirect::pwd();
			}

			return;

		}

		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['desc'] = \dash\request::post('desc');

		\lib\app\setting\shipping_method::add($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Package added"));
			\dash\redirect::pwd();
		}

	}
}
?>