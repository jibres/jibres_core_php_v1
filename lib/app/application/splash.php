<?php
namespace lib\app\application;


class splash
{

	public static function set($_splash)
	{

		if(!$_splash || !is_array($_splash))
		{
			\dash\notif::error(T_("Please set your splash setting"), 'splash');
			return false;
		}

		$ok_splash = [];
		$index = 1;

		foreach ($_splash as $key => $value)
		{
			if(!isset($value['title']))
			{
				continue;
			}

			if(!isset($value['desc']))
			{
				continue;
			}

			if(!$value['title'] || !$value['desc'])
			{
				continue;
			}

			if(mb_strlen($value['title']) > 50)
			{
				\dash\notif::error(T_("Splash page title must be less than 50 character"), 'title'. $index);
				return false;
			}

			if(mb_strlen($value['desc']) > 100)
			{
				\dash\notif::error(T_("Splash page desc must be less than 100 character"), 'desc'. $index);
				return false;
			}

			$ok_splash[$index] =
			[
				'title' => $value['title'],
				'desc'  => $value['desc'],
			];

			$index++;

		}

		if(!$ok_splash)
		{
			\dash\notif::error(T_("Please fill the splash detail"));
			return false;
		}

		foreach ($ok_splash as $key => $value)
		{
			\lib\app\application\tools::save('splash_'. $key, json_encode($value, JSON_UNESCAPED_UNICODE));
		}


		\dash\notif::ok(T_("Application splash set"));
		return true;
	}


	public static function get()
	{
		$result = \lib\db\setting\get::splash();
		if(!$result || !is_array($result))
		{
			$result = [];
		}

		$splash = [];

		foreach ($result as $key => $value)
		{
			$index = $key + 1;
			$meta = json_decode($value['value'], true);
			$temp  = [];

			if(isset($meta['title']))
			{
				$temp['title'] = $meta['title'];
			}

			if(isset($meta['desc']))
			{
				$temp['desc'] = $meta['desc'];
			}

			$splash[$index] = $temp;

		}

		return $splash;
	}

}
?>