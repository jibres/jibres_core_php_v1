<?php
namespace lib\app\application;


class splash
{

	public static function set_android_theme($_theme)
	{
		$_theme = \dash\validate::string($_theme);
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

		$get = \lib\db\setting\get::platform_cat_key('android', 'splash', 'splash_theme');

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
				'key'      => 'splash_theme',
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


	private static function theme_color()
	{
		$theme_color =
		[
			"gradient0"  => ["start" => "#6DE195",   "end" => "#C4E759"],
			"gradient1"  => ["start" => "#41C7AF",   "end" => "#54E38E"],
			"gradient2"  => ["start" => "#99E5A2",   "end" => "#D4FC78"],
			"gradient3"  => ["start" => "#ABC7FF",   "end" => "#C1E3FF"],
			"gradient4"  => ["start" => "#6CACFF",   "end" => "#8DEBFF"],
			"gradient5"  => ["start" => "#5583EE",   "end" => "#41D8DD"],
			"gradient6"  => ["start" => "#A16BFE",   "end" => "#DEB0DF"],
			"gradient7"  => ["start" => "#D279EE",   "end" => "#F8C390"],
			"gradient8"  => ["start" => "#F78FAD",   "end" => "#FDEB82"],
			"gradient9"  => ["start" => "#BC3D2F",   "end" => "#A16BFE"],
			"gradient10" => ["start" => "#A43AB2",   "end" => "#E13680"],
			"gradient11" => ["start" => "#9D2E7D",   "end" => "#E16E93"],
			"gradient12" => ["start" => "#F5CCF6",   "end" => "#F1EEF9"],
			"gradient13" => ["start" => "#F0EFF0",   "end" => "#FAF8F9"],
			"gradient14" => ["start" => "#121317",   "end" => "#323B42"],
		];
	}


}
?>