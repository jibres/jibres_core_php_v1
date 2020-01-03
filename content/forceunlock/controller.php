<?php
namespace content\forceunlock;


class controller
{
	public static function routing()
	{
		if(!\dash\engine\lock::is())
		{
			\dash\header::status(400);
		}

		if(!\dash\request::get('force'))
		{
			\dash\header::status(400);
		}

		\dash\data::startLock(\dash\engine\lock::when());
	}
}
?>