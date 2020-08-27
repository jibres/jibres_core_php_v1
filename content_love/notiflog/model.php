<?php
namespace content_love\notiflog;


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
