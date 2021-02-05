<?php
namespace content_b1\ticket\detail;


class view
{

	public static function config()
	{
		$conversation = [];

		$id = \dash\request::get('id');

		$load = \dash\app\ticket\get::get($id);

		if(isset($load['parent']) && $load['parent'])
		{
			\dash\notif::error(T_("Please set the master ticket id"));
			\content_b1\tools::say($conversation);
			return false;
		}

		if($load)
		{
			$conversation = \dash\app\ticket\get::conversation($id);
		}

		\content_b1\tools::say($conversation);


	}
}
?>