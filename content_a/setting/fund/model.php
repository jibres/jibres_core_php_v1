<?php
namespace content_a\setting\fund;


class model
{

	public static function post()
	{
		$post           = [];
		$post['title']  = \dash\request::post('title');
		$post['status'] = \dash\request::post('status');
		$post['pos']    = \dash\request::post('pos');

		if(\dash\data::dataRow())
		{
			\lib\app\fund::edit($post, \dash\request::get('id'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Fund successfully updated"));
				\dash\redirect::to(\dash\url::this(). '/fund');
			}
		}
		else
		{
			\lib\app\fund::add($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Fund successfully added"));
				\dash\redirect::pwd();
			}
		}

	}
}
?>