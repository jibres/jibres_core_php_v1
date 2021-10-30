<?php
namespace content_crm\log\notif;


class model
{
	public static function post()
	{
		if(\dash\request::post('emptytable') === 'emptytable' && \dash\permission::supervisor())
		{
			\dash\db\log_notif\delete::all();
			\dash\redirect::pwd();
		}
	}

}
?>
