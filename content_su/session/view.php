<?php
namespace content_su\session;


class view
{
	public static function config()
	{
		if(isset($_SESSION))
		{
			\dash\data::session($_SESSION);
		}
	}
}
?>