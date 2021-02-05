<?php
namespace content_b1\transactions\detail;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$detail = \dash\app\transaction\get::get($id);

		if(!$detail)
		{
			\dash\notif::error(T_("Transaction not found"));
		}

		\content_b1\tools::say($detail);
	}
}
?>