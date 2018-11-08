<?php
namespace content_a\setting\pos;


class model
{
	public static function post()
	{
		if(\dash\request::post('type') === 'default')
		{
			$result = \lib\app\store\pos::default(\dash\request::post('key'));

			if($result)
			{
				\dash\redirect::pwd();
			}
		}
		elseif(\dash\request::post('type') === 'remove')
		{
			$result = \lib\app\store\pos::remove(\dash\request::post('key'));

			if($result)
			{
				\dash\notif::warn(T_("Pos removed"));
				\dash\redirect::pwd();
			}
		}
		else
		{
			$post = \dash\request::post();

			$result = \lib\app\store\pos::add($post);

			if($result)
			{
				\dash\notif::ok(T_("Pos setting saved"));
				\dash\redirect::pwd();
			}
		}
	}
}
?>