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
				\dash\redirect::to(\dash\url::current());
			}

			return;

		}

		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['length'] = \dash\request::post('length');
		$post['width']  = \dash\request::post('width');
		$post['height'] = \dash\request::post('height');
		$post['weight'] = \dash\request::post('weight');

		if(\dash\data::editMode())
		{
			\lib\app\setting\package::edit($post, \dash\request::get('id'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Package edited"));
				\dash\redirect::to(\dash\url::current());
			}
		}
		else
		{
			\lib\app\setting\package::add($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Package added"));
				\dash\redirect::pwd();
			}
		}



	}
}
?>