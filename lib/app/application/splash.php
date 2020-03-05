<?php
namespace lib\app\application;


class splash
{

	public static function set_android_theme($_theme)
	{
		if(!$_theme)
		{
			\dash\notif::error(T_("Please choose your theme"), 'theme');
			return false;
		}

		if(!in_array($_theme, ['blue','red','yellow','green','balck']))
		{
			\dash\notif::error(T_("Invalid theme"), 'theme');
			return false;
		}

		$get = \lib\db\setting\get::platform_cat_key('android', 'splash', 'theme');

		if(isset($get['id']))
		{
			\lib\db\setting\update::value($_theme, $get['id']);
		}
		else
		{
			$insert =
			[
				'platform' => 'android',
				'cat'      => 'splash',
				'key'      => 'theme',
				'value'    => $_theme,
			];

			\lib\db\setting\insert::new_record($insert);
		}

		\dash\notif::ok(T_("Application intro set"));
		return true;

	}


	public static function get_android()
	{
		$result = \lib\db\setting\get::platform_cat('android', 'splash');

		if(!is_array($result))
		{
			$result = [];
		}

		$splash = [];

		foreach ($result as $key => $value)
		{
			$splash[$value['key']] = $value['value'];
		}

		return $splash;

	}


}
?>