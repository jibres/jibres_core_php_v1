<?php
namespace content_su\update;

class view
{
	public static function config()
	{
		\dash\data::isLockService(\dash\engine\lock::is());
	}
}
?>