<?php
namespace content_a\setting\shipping\method;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\setting\shipping_method::remove(\dash\request::post('id'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Shipping method removed"));
				\dash\redirect::to(\dash\url::current());
			}

			return;

		}

		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['desc']   = \dash\request::post('desc');
		$post['status'] = \dash\request::post('status');


		if(\dash\data::editMode())
		{
			\lib\app\setting\shipping_method::edit($post, \dash\request::get('id'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Shipping method edited"));
				\dash\redirect::to(\dash\url::current());
			}
		}
		else
		{
			\lib\app\setting\shipping_method::add($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Shipping method added"));
				\dash\redirect::pwd();
			}
		}



	}
}
?>