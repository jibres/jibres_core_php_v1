<?php
namespace content_love\business\statistics;

class model
{
	public static function post()
	{
		\dash\code::time_limit(0);

		\content_hook\job\business::run_once(['\\lib\\app\\sync\\statistics', 'fire']);

		\dash\notif::ok(T_("All business sitemap created"));
		\dash\redirect::pwd();
		return;

	}
}
?>