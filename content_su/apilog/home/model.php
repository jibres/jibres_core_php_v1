<?php
namespace content_su\apilog\home;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'lastmonth')
		{
			$count = \dash\db\apilog::remove_last_month();
			\dash\notif::ok(T_(":count log was removed", ['count' => \dash\fit::number($count)]));
			\dash\redirect::pwd();
		}
	}
}
?>