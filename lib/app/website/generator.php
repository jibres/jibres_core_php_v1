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

		$website_setting = [];

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
			$load_query = self::load_setting();
			if(!is_array($load_query))
			{
				$load_query = [];
			}

			$load_query['update_time'] = time();

			$website_setting = $load_query;

			\dash\file::write($addr, json_encode($website_setting, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

		}

		// website is not active !! BUG!
		if(!isset($website_setting['template']))
		{
			return false;
		}


		$new_website_mode = null;
		if(\dash\request::get('websitemode'))
		{
			$get_website_type = \dash\validate::enum(\dash\request::get('websitemode'), false ,['enum' => ['visitcard', 'stat', 'comingsoon', 'shop']]);

			if($get_website_type && \dash\user::id())
			{
				if(\dash\permission::is_admin())
				{
					$new_website_mode = $get_website_type;
				}
			}
		}

		$load_template = $new_website_mode ? $new_website_mode : $website_setting['template'];

		switch ($load_template)
		{

			case 'stat':
				$website_setting['template'] = $load_template;
				$website_setting['header']   = ['active' => 'header_comingsoon'];
				$website_setting['footer']   = ['active' => 'footer_comingsoon'];
				$website_setting['body_raw'] = 'comingsoon';
				break;

			case 'comingsoon':
				$website_setting['template'] = $load_template;
				$website_setting['header']   = ['active' => 'header_comingsoon'];
				$website_setting['footer']   = ['active' => 'footer_comingsoon'];
				$website_setting['body_raw'] = 'comingsoon';
				break;

			case 'shop':
			case 'publish':
				$website_setting['template'] = 'publish';
				break;


			case 'visitcard':
			default:
				$website_setting['template'] = $load_template;
				$website_setting['header']   = ['active' => 'header_visitcard'];
				$website_setting['footer']   = ['active' => 'footer_visitcard'];
				$website_setting['body_raw'] = 'visitcard';
				break;
		}



		return $website_setting;
	}



	private static function load_setting()
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

		// if($result['template'] === 'publish')
		{
			$load_all_website = \lib\app\website\body\get::get_sort_body_line(true);


			if(!is_array($load_all_website))
			{
				$load_all_website = [];
			}

			foreach ($load_all_website as $key => $value)
			{

				if(!isset($value['cat']) || !isset($value['key']) || !isset($value['value']))
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


					if(isset($myValue['type']))
					{
						$myType = $myValue['type'];

						if(in_array($myValue['type'], ['news']))
						{
							$myType = 'datablock';
						}

						$fn = ['\\lib\\app\\website\\body\\line\\'. $myType, 'ready'];
						if(is_callable($fn))
						{
							$fn1 = $fn[0];
							$fn2 = $fn[1];

							$myValue = $fn1::$fn2($myValue);

						}
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
}
?>