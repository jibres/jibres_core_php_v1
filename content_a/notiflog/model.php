<?php
namespace content_a\notiflog;


class model
{
	public static function post()
	{
		if(\dash\request::post('emptytable') === 'emptytable')
		{
			\dash\db\log_notif\delete::all();
			\dash\redirect::pwd();
		}
	}

}
?>
