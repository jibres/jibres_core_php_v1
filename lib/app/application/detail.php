<?php
namespace lib\app\application;


class detail
{
	private static $app_detail = [];

	public static function can_user_store_logo()
	{
		$store_logo = \lib\store::logo();
		if(!$store_logo)
		{
			return false;
		}

		if(!\dash\upload\crop::check_square($store_logo))
		{
			return false;
		}

		$image_detail = @getimagesize($store_logo);
		if(isset($image_detail['mime']) && $image_detail['mime'] === 'image/png')
		{
			return true;
		}

		return false;
	}


	public static function set_android_logo_from_store_logo()
	{

		if(!self::can_user_store_logo())
		{
			if(\lib\store::logo())
			{
				\dash\notif::error(T_("Your store logo is not set"));
				return false;
			}
			else
			{
				\dash\notif::error(T_("Your store logo is not a square logo"));
				return false;
			}
		}
		else
		{
			$store_logo = \lib\store::logo();
			$store_logo = \lib\filepath::raw_path($store_logo);
			self::set_android_logo($store_logo);
		}
	}

	public static function remove_logo()
	{
		$get = \lib\db\setting\get::platform_cat_key('android', 'setting', 'logo');

		if(isset($get['id']))
		{
			\lib\db\setting\delete::record($get['id']);
			\dash\notif::ok(T_("Your application logo was removed"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("You have not any application logo!"));
			return false;
		}
	}


	public static function set_android_logo($_logo = null)
	{
		if(!$_logo)
		{
			$logo = \dash\upload\store_logo::app_android_logo_set();
		}
		else
		{
			$logo = $_logo;
		}

		$get = \lib\db\setting\get::platform_cat_key('android', 'setting', 'logo');

		if($logo)
		{

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

			\dash\notif::ok(T_("Your application logo was saved"));

		}
		else
		{
			if(\dash\engine\process::status())
			{
				if(isset($get['id']))
				{
					// whe have old logo
					\dash\notif::info(T_("Your application logo saved without change"));
				}
				else
				{
					\dash\notif::error(T_("Please choose a file to set as your application logo"));
				}
			}
		}
	}


	public static function set_android_detail($_args)
	{
		$condition =
		[
			'title'  => 'string_20',
			'desc'   => 'string_150',
			'slogan' => 'string_50',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$change = false;


		self::set_setting_record('title', $data['title']);

		self::set_setting_record('desc', $data['desc']);

		self::set_setting_record('slogan', $data['slogan']);


		\dash\notif::ok(T_("Application setting set"));


		return true;

	}


	public static function set_android_download_detail($_args)
	{
		$condition =
		[
			'googleplay'    => 'url',
			'cafebazar'     => 'url',
			'myket'         => 'url',
			'downloadtitle' => 'title',
			'downloaddesc'  => 'desc',

		];

		$require = [];
		$meta    =	[];
		$data    = \dash\cleanse::input($_args, $condition, $require, $meta);



		self::set_setting_record('googleplay', $data['googleplay']);
		self::set_setting_record('cafebazar', $data['cafebazar']);
		self::set_setting_record('myket', $data['myket']);
		self::set_setting_record('downloadtitle', $data['downloadtitle']);
		self::set_setting_record('downloaddesc', $data['downloaddesc']);


		\dash\notif::ok(T_("Application download setting saved"));
	}


	/**
	 * Gets the dowload page detail
	 *
	 * @return     array  The dowload page.
	 */
	public static function get_dowload_page()
	{
		$get = \lib\db\setting\get::application_dowload_page();
		if(!is_array($get))
		{
			return [];
		}

		$get = array_column($get, 'value', 'key');
		return $get;
	}



	private static function set_setting_record($_key, $_value)
	{
		$get = \lib\db\setting\get::platform_cat_key('android', 'setting', $_key);

		if(isset($get['value']) && $get['value'] === $_value)
		{
			// no change
			return true;
		}

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
		if(!self::$app_detail)
		{
			self::$app_detail = \lib\db\setting\get::platform('android');
		}

		$setting = self::$app_detail;

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
					if(substr($value['value'], 0,1) === '{')
					{
						$value['value'] = json_decode($value['value'], true);
						if(isset($value['value']['file']))
						{
							$value['value']['file'] = \lib\filepath::fix($value['value']['file']);
						}
					}
					$result[$value['key']] = $value['value'];
				}
			}
		}

		return $result;

	}



	public static function is_ready_to_create($_data = null)
	{

		if(!$_data)
		{
			$_data = self::get_android();
		}

		$is_ok = true;
		$message = [];

		$default =
		[
			"logo"   => null,
			"title"  => null,
			"desc"   => null,
			"slogan" => null,
			"theme"  => null,
			"page_1" =>
			[
				"title" => null,
				"desc"  => null,
				"file"  => null,
			],

			"page_2" =>
			[
				"title" => null,
				"desc"  => null,
				"file"  => null,
			],

			"page_3" =>
			[
				"title" => null,
				"desc" => null,
				"file" => null,
			],

			// "intro_theme"  => null,
			"splash_theme" => null,
		];

		if(!is_array($_data))
		{
			$_data = [];
		}

		$check = array_merge($default, $_data);

		if(!$check['logo'])
		{
			$is_ok = false;
			$message[] = T_("Please set your application logo");
		}

		if(!$check['title'])
		{
			$is_ok = false;
			$message[] = T_("Please set your application title");
		}

		// if(!$check['intro_theme'])
		// {
		// 	$is_ok = false;
		// 	$message[] = T_("Please set your application intro theme");
		// }

		if(!$check['splash_theme'])
		{
			$is_ok = false;
			$message[] = T_("Please choose application splash theme");
		}



		$result        = [];
		$result['ok']  = $is_ok;
		$result['msg'] = $message;

		return $result;

	}


	public static function make_setup_guide($_data = null)
	{

		$setupGuideDetail =
		[
			'setting'  => false,
			'logo'     => false,
			'intro'    => false,
			'splash'   => false,
			'apk'      => false,
			'download' => false,
		];

		if(!$_data)
		{
			$_data = self::get_android();
		}

		$is_ok = true;
		$message = [];

		$default =
		[
			"logo"   => null,
			"title"  => null,
			"desc"   => null,
			"slogan" => null,
			"theme"  => null,
			"page_1" =>
			[
				"title" => null,
				"desc"  => null,
				"file"  => null,
			],

			"page_2" =>
			[
				"title" => null,
				"desc"  => null,
				"file"  => null,
			],

			"page_3" =>
			[
				"title" => null,
				"desc" => null,
				"file" => null,
			],

			// "intro_theme"  => null,
			"splash_theme" => null,
		];

		if(!is_array($_data))
		{
			$_data = [];
		}

		$check = array_merge($default, $_data);

		if($check['logo'])
		{
			$setupGuideDetail['logo'] = true;
		}

		if($check['title'])
		{
			$setupGuideDetail['setting'] = true;
		}

		if($check['page_1']['title'])
		{
			$setupGuideDetail['intro'] = true;
		}

		if($check['splash_theme'])
		{
			$setupGuideDetail['splash'] = true;
		}


		if($check['splash_theme'])
		{
			$setupGuideDetail['splash'] = true;
		}

		if($check['splash_theme'])
		{
			$setupGuideDetail['splash'] = true;
		}

		$queue_detail = \lib\app\application\queue::detail();
		if(isset($queue_detail['status']) && $queue_detail['status'])
		{
			$setupGuideDetail['apk'] = true;
		}

		return $setupGuideDetail;

	}



}
?>