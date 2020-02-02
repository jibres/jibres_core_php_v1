<?php
namespace lib\app\application;


class theme
{

	public static function set($_theme)
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

		\lib\app\application\tools::save('intro_theme', $_theme);

		\dash\notif::ok(T_("Application intro set"));
		return true;
	}


	public static function get()
	{
		$result = \lib\app\application\tools::get('intro_theme');
		if(isset($result['value']))
		{
			return $result['value'];
		}
		return null;
	}

}
?>