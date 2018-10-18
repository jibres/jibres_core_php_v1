<?php
namespace content_a\setting\pos;


class model
{
	public static function post()
	{
		$post = \dash\request::post();

		$result = \lib\app\store\pos::set($post);

		if($result)
		{
			\dash\notif::ok(T_("Pos setting saved"));
			\dash\redirect::pwd();
		}


	}
}
?>