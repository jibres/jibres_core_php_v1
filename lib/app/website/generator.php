<?php
namespace lib\app\website;

class generator
{
	public static function remove_catch()
	{
		\dash\file::delete(\dash\engine\store::website_addr(). \lib\store::id(). \dash\engine\store::$ext);
	}



	/**
	 * Loads a website setting from file and database
	 *
	 * @param      <type>         $_store_id  The store identifier
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function load_website_setting()
	{
		// load by get
		$get_website_type = \dash\validate::enum(\dash\request::get('websitemode'), false ,['enum' => ['visitcard', 'stat', 'comingsoon', 'shop']]);

		if($get_website_type)
		{
			$setting = [];

			switch ($get_website_type)
			{
				case 'stat':
					$setting = self::website_stat_setting();
					break;

				case 'comingsoon':
					$setting = self::website_comingsoon_setting();
					break;

				case 'shop':
					$setting = self::website_shop_setting();
					break;


				case 'visitcard':
				default:
					$setting = self::website_visitcard_setting();
					break;
			}

			return $setting;
		}


		$addr = \dash\engine\store::website_addr();

		if(!is_dir($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}

		$addr .= \lib\store::id(). \dash\engine\store::$ext;

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
			$load_query = self::get_template();
			if(!is_array($load_query))
			{
				$load_query = [];
			}

			$load_query['update_time'] = time();

			$website_setting = $load_query;

			\dash\file::write($addr, json_encode($website_setting, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

		}

		if(isset($website_setting['template']))
		{
			return $website_setting;
		}

		return false;

	}

	public static function get_template()
	{
		// check from file
		// get from query
		// save from file

		$result  = [];
		$setting = [];

		$active_status = \lib\db\setting\get::platform_cat_key('website', 'status', 'active');

		if(!$active_status || !isset($active_status['value']))
		{
			$result['template'] = 'visitcard';
		}
		else
		{
			$result['template'] = $active_status['value'];
		}

		if($result['template'] === 'publish')
		{
			$load_all_website = \lib\app\website\body\get::get_sort_body_line(true);


			if(!is_array($load_all_website))
			{
				$load_all_website = [];
			}

			foreach ($load_all_website as $key => $value)
			{

				if(!isset($value['value']) || !isset($value['value']) || !isset($value['value']))
				{
					continue;
				}

				$myValue = $value['value'];

				if(substr($myValue, 0, 1) === '{' || substr($myValue, 0, 1) === '[' )
				{
					$myValue = json_decode($myValue, true);
				}

				if(strpos($value['cat'], 'header') !== false)
				{
					$setting['header'][$value['key']] = $myValue;
				}


				if(strpos($value['cat'], 'footer') !== false)
				{
					$setting['footer'][$value['key']] = $myValue;
				}

				if(strpos($value['cat'], 'menu') !== false)
				{
					$setting['menu'][$value['key']] = $myValue;
				}

				if($value['cat'] === 'homepage')
				{
					if(!isset($setting['body']))
					{
						$setting['body'] = [];
					}

					$setting['body'][] = ['cat' => $value['cat'], 'key' => $value['key'], 'value' => $myValue];
				}

			}

		}

		$result = array_merge($result, $setting);

		return $result;
	}


	/**
	 * Only get body setting
	 *
	 * @return     array  The body line.
	 */
	public static function get_body_line()
	{
		$setting = self::load_website_setting();

		if(isset($setting['body']) && is_array($setting['body']))
		{
			return $setting['body'];
		}
		return [];
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


	private static function website_shop_setting()
	{

		$setting =
		[
			'template' => 'publish',
			'header'   => ['active' => 'header_2'],
			'footer'   => ['active' => 'footer_2'],
			'lines' =>
			[
				'list' =>
				[
					[
						'type' => 'body_last_product',
						'limit' => 6,
					]
				]
			],
		];
		return $setting;
	}


}
?>