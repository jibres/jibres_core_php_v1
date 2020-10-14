<?php
namespace dash\social\telegram;

class session
{
	public static function forceSet()
	{

		$newName = \dash\url::root().'Telegram'. hook::from('id');
		\dash\session::restart($newName, false);
	}
}
?>