<?php
namespace content_business\f\home;

class model
{
	public static function post()
	{
		\dash\notif::ok(T_("Not ready"));
		return;
		$post = \dash\request::post();
		var_dump($post);exit();
	}
}
?>