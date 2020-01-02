<?php
namespace content_su\update;

class model
{
	public static function post()
	{
		\lib\app\upgradedb\upgrade::run();
		\dash\redirect::pwd();
		return;
	}
}
?>