<?php
namespace content_b1\user\notes\fetch;


class view
{
	public static function config()
	{
		$id = \dash\request::get('userid');

		$detail = \dash\app\user\description::list($id);

		if(!$detail)
		{
			\dash\notif::info(T_("No description founded"));
		}

		\content_b1\tools::say($detail);
	}
}
?>