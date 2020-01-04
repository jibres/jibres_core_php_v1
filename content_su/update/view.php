<?php
namespace content_su\update;

class view
{
	public static function config()
	{
		\dash\data::isLockService(\dash\engine\lock::is());

		$needUpgrade = \lib\app\upgradedb\upgrade::need_upgrade();
		\dash\data::needUpgrade($needUpgrade);

	}
}
?>