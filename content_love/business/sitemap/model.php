<?php
namespace content_love\business\sitemap;

class model
{
	public static function post()
	{

		\dash\code::time_limit(0);

		\content_hook\job\business::run(['\\dash\\utility\\sitemap', 'create_all']);

		\dash\notif::ok(T_("All business sitemap created"));
		\dash\redirect::pwd();
		return;

	}
}
?>