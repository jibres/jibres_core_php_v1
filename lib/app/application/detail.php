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

		$get = \lib\db\setting\get::platform_cat_key('android', 'setting', 'title');

		if(isset($get['id']))
		{
			\lib\db\setting\update::value($title, $get['id']);
		}
		else
		{
			$insert =
			[
				'platform' => 'android',
				'cat'      => 'setting',
				'key'      => 'title',
				'value'    => $title,
			];

			\lib\db\setting\insert::new_record($insert);
		}

		\dash\notif::ok(T_("Application setting set"));
		return true;

	}


	public static function get_android()
	{
		$logo = \lib\db\setting\get::platform_cat_key('android', 'setting', 'logo');
		if(isset($logo['value']))
		{
			$logo = $logo['value'];
		}
		else
		{
			$logo = null;
		}

		if(!$logo)
		{
			$logo = \lib\store::detail('logo');
		}

		$title = \lib\db\setting\get::platform_cat_key('android', 'setting', 'title');

		if(isset($title['value']))
		{
			$title = $title['value'];
		}
		else
		{
			$title = null;
		}

		if(!$title)
		{
			$title = \lib\store::detail('title');

		}

		$result =
		[
			'logo'  => \lib\filepath::fix($logo),
			'title' => $title,
		];

		return $result;

	}


}
?>