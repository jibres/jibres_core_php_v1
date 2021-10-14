<?php
namespace content_site\autosave;

class model
{
	public static function post()
	{
		if(\dash\request::post('rebuild') === 'rebuild')
		{
			\dash\notif::ok(T_("Setting saved"));
			\dash\redirect::pwd();
			return;
		}

	}
}
?>