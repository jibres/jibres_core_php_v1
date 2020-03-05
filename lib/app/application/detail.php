<?php
namespace lib\app\application;


class detail
{

	public static function set_android_detail($_args)
	{
		$logo = \dash\upload\store_logo::app_android_logo_set();
		if($logo)
		{
			$get = \lib\db\setting\get::platform_cat_key('android', 'setting', 'logo');

			if(isset($get['id']))
			{
				\lib\db\setting\update::value($logo, $get['id']);
			}
			else
			{
				$insert =
				[
					'platform' => 'android',
					'cat'      => 'setting',
					'key'      => 'logo',
					'value'    => $logo,
				];

				\lib\db\setting\insert::new_record($insert);
			}

		}

		$title = isset($_args['title']) ? $_args['title'] : null;
		if(!$title)
		{
			\dash\notif::error(T_("Please set your application title"), 'title');
			return false;
		}

		if(mb_strlen($title) > 20)
		{
			\dash\notif::error(T_("Your application title must be less than 20 character"));
			return false;
		}


		self::set_setting_record('title', $title);

		$desc = isset($_args['desc']) ? $_args['desc'] : null;

		if($desc && mb_strlen($desc) > 150)
		{
			\dash\notif::error(T_("Your application desc must be less than 150 character"));
			return false;
		}

		self::set_setting_record('desc', $desc);


		$slogan = isset($_args['slogan']) ? $_args['slogan'] : null;


		if($slogan && mb_strlen($slogan) > 50)
		{
			\dash\notif::error(T_("Your application slogan must be less than 50 character"));
			return false;
		}


		self::set_setting_record('slogan', $slogan);


		\dash\notif::ok(T_("Application setting set"));
		return true;

	}


	private static function set_setting_record($_key, $_value)
	{
		$get = \lib\db\setting\get::platform_cat_key('android', 'setting', $_key);

		if(isset($get['id']))
		{
			\lib\db\setting\update::value($_value, $get['id']);
		}
		else
		{
			$insert =
			[
				'platform' => 'android',
				'cat'      => 'setting',
				'key'      => $_key,
				'value'    => $_value,
			];

			\lib\db\setting\insert::new_record($insert);
		}
	}


	public static function get_android()
	{

		$setting = \lib\db\setting\get::platform_cat('android', 'setting');
		$result = [];
		foreach ($setting as $key => $value)
		{
			if(isset($value['key']) && isset($value['value']))
			{
				if($value['key'] === 'logo')
				{
					$result['logo'] = \lib\filepath::fix($value['value']);
				}
				else
				{
					$result[$value['key']] = $value['value'];
				}
			}
		}

		return $result;

	}


}
?>