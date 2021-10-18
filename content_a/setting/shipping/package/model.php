<?php
namespace content_a\setting\shipping\package;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\setting\package::remove(\dash\request::post('id'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Package removed"));
				\dash\redirect::pwd();
			}

			return;

		}

		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['length'] = \dash\request::post('length');
		$post['width']  = \dash\request::post('width');
		$post['height'] = \dash\request::post('height');
		$post['weight'] = \dash\request::post('weight');

		\lib\app\setting\package::add($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Package added"));
			\dash\redirect::pwd();
		}

	}
}
?>