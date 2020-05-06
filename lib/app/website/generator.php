<?php
namespace lib\app\website;

class generator
{
	public static function remove_catch()
	{
		\dash\file::delete(\dash\engine\store::website_addr(). \lib\store::id());
	}



	/**
	 * Loads a website setting from file and database
	 *
	 * @param      <type>         $_store_id  The store identifier
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function load_website_setting($_store_id)
	{
		// load by get
		$get_website_type = \dash\validate::enum(\dash\request::get('websitemode'), false ,['enum' => ['visitcard', 'stat', 'comingsoon']]);
		if($get_website_type)
		{
			return self::website_setting_on_fly($get_website_type);
		}


		$addr = \dash\engine\store::website_addr();

		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}

		$addr .= $_store_id;

		$website_setting = [];

		if(is_file($addr))
		{
			$load = \dash\file::read($addr);
			$load = json_decode($load, true);
			if(!is_array($load))
			{
				$load = [];
			}

			$website_setting = $load;
		}

		if(empty($website_setting))
		{
			$load_query = \lib\app\website\template::get();
			if(!is_array($load_query))
			{
				$load_query = [];
			}

			$load_query['update_time'] = time();

			$website_setting = $load_query;

			\dash\file::write($addr, json_encode($website_setting, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

		}

		// var_dump($website_setting);exit();
		if(isset($website_setting['template']))
		{
			return $website_setting;
		}

		return false;

	}


	private static function website_setting_on_fly($_type)
	{
		$setting = [];

		switch ($_type)
		{
			case 'stat':
				$setting = self::website_stat_setting();
				break;

			case 'comingsoon':
				$setting = self::website_comingsoon_setting();
				break;

			case 'visitcard':
			default:
				$setting = self::website_visitcard_setting();
				break;
		}

		return $setting;
	}


	private static function website_stat_setting()
	{
		$setting =
		[
			'template' => 'publish',
			'header'   => ['active' => 'header_stat'],
			'footer'   => ['active' => 'footer_stat'],
			'body_raw' => 'stat',
		];
		return $setting;
	}


	private static function website_comingsoon_setting()
	{
		$setting =
		[
			'template' => 'publish',
			'header'   => ['active' => 'header_comingsoon'],
			'footer'   => ['active' => 'footer_comingsoon'],
			'body_raw' => 'comingsoon',
		];
		return $setting;
	}


	private static function website_visitcard_setting()
	{
		$setting =
		[
			'template' => 'publish',
			'header'   => ['active' => 'header_visitcard'],
			'footer'   => ['active' => 'footer_visitcard'],
			'body_raw' => 'visitcard',
		];
		return $setting;
	}


}
?>