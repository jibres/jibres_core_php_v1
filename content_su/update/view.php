<?php
namespace content_su\update;

class view
{
	public static function config()
	{
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::isLockService(\dash\engine\lock::is());

		$needUpgrade = \lib\app\upgradedb\upgrade::need_upgrade();
		\dash\data::needUpgrade($needUpgrade);

		\dash\data::lastDBVersion(['jibres' => \lib\app\upgradedb\upgrade::jibres_last_upgrade_version(), 'store' => \lib\app\upgradedb\upgrade::store_min_version()]);

	}
}
?>