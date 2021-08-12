<?php
namespace content_crm\member\export;


class model
{
	public static function post()
	{
		\dash\app\user\export::queue();
		\dash\redirect::pwd();
	}
}
?>
