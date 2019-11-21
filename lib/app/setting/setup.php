<?php
namespace lib\app\setting;


class setup
{
	private static $setting_cat = 'setup';
	private static $levels =
	[
		'owner',
		'logo',
		'address',
		'barcode',
		'scale',
		'vat',
	];

	public static function complete($_set_complete = false)
	{
		// if complete setup return true
		$get = \lib\app\setting\tools::get_cat(self::$setting_cat);

		if(count($get) >= count(self::$levels))
		{
			return true;
		}
		return false;
	}

	public static function next_level($_current_level = null)
	{
		if($_current_level)
		{
			if(in_array($_current_level, self::$levels))
			{
				$current_level_key = array_search($_current_level, self::$levels);
				$next_level_key = $current_level_key + 1;
				if(isset(self::$levels[$next_level_key]))
				{
					return self::$levels[$next_level_key];
				}
				else
				{
					return null;
				}
			}
			else
			{
				return self::$levels[0];
			}
		}
		else
		{
			return self::$levels[0];
		}
	}


	public static function __callStatic($_fn, $_args)
	{
		if(in_array($_fn, self::$levels))
		{
			$get = \lib\app\setting\tools::get(self::$setting_cat, $_fn);
			if(!$get)
			{
				\lib\app\setting\tools::save(self::$setting_cat, $_fn, 'ok');
			}

			$next_level = self::next_level($_fn);
			if($next_level)
			{
				return \dash\url::here(). '/setup/'. $next_level;
			}
			else
			{
				return \dash\url::here();
			}

		}
	}


	public static function upload_logo()
	{
		$file = \dash\app\file::upload_quick('logo');
		if($file)
		{
			\lib\app\setting\tools::update('store_setting', 'logo', $file);
		}
	}


	public static function save_address($_args)
	{
		\dash\app::variable($_args);


		$country = \dash\app::request('country');

		if($country && mb_strlen($country) > 100)
		{
			\dash\notif::error(T_("Please set country less than 100 character"), 'country');
			return false;
		}

		if($country && !\dash\utility\location\countres::check($country))
		{
			\dash\notif::error(T_("Invalid country"), 'country');
			return false;
		}

		$province = \dash\app::request('province');
		if($province && mb_strlen($province) > 100)
		{
			\dash\notif::error(T_("Please set province less than 100 character"), 'province');
			return false;
		}

		if($province && !\dash\utility\location\provinces::check($province))
		{
			\dash\notif::error(T_("Invalid province"), 'province');
			return false;
		}

		$city = \dash\app::request('city');
		if($city && mb_strlen($city) > 100)
		{
			\dash\notif::error(T_("Please set city less than 100 character"), 'city');
			return false;
		}

		if(!$province && $city)
		{
			$province = \dash\utility\location\cites::get($city, 'province', 'province');
			if(!\dash\utility\location\provinces::check($province))
			{
				$province = null;
			}
		}

		$address = \dash\app::request('address');
		if($address && mb_strlen($address) > 300)
		{
			\dash\notif::error(T_("Please set address less than 300 character"), 'address');
			return false;
		}


		$mobile = \dash\app::request('mobile');
		if($mobile && !\dash\utility\filter::mobile($mobile))
		{
			\dash\notif::error(T_("Invalid mobile"), 'mobile');
			return false;
		}

		$postcode = \dash\app::request('postcode');
		if($postcode && mb_strlen($postcode) > 50)
		{
			\dash\notif::error(T_("Please set postcode less than 50 character"), 'postcode');
			return false;
		}

		$phone = \dash\app::request('phone');
		if($phone && mb_strlen($phone) > 50)
		{
			\dash\notif::error(T_("Please set phone less than 50 character"), 'phone');
			return false;
		}

		$fax = \dash\app::request('fax');
		if($fax && mb_strlen($fax) > 50)
		{
			\dash\notif::error(T_("Please set fax less than 50 character"), 'fax');
			return false;
		}

		$args             = [];
		$args['country']  = $country;
		$args['province'] = $province;
		$args['city']     = $city;
		$args['address']  = $address;
		$args['mobile']   = $mobile;
		$args['postcode'] = $postcode;
		$args['phone']    = $phone;
		$args['fax']      = $fax;

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update('store_setting', $key, $value);
		}

		return true;
	}
}
?>