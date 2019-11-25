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
		'company',
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


	public static function ready($_module)
	{
		if(in_array($_module, self::$levels))
		{
			$current_step = array_search($_module, self::$levels) + 1;
			$all = count(self::$levels);
			// set stepDesc
			$stepDesc = T_('Step') . ' ';
			$stepDesc .= \dash\utility\human::fitNumber($current_step). ' ';
			$stepDesc .= T_('of') . ' ';
			$stepDesc .= \dash\utility\human::fitNumber($all);
			\dash\data::stepDesc($stepDesc);
		}


	}


	public static function have_barcode($_have_barcode)
	{
		$have_barcode = $_have_barcode ? 'yes' : 'no';
		if($have_barcode)
		{
			\lib\app\setting\tools::update('store_setting', 'barcode', $have_barcode);
		}
	}


	public static function have_vat($_have_vat)
	{
		$have_vat = $_have_vat ? 'yes' : 'no';
		if($have_vat)
		{
			\lib\app\setting\tools::update('store_setting', 'vat', $have_vat);
		}
	}


	public static function have_scale($_have_scale)
	{
		$have_scale = $_have_scale ? 'yes' : 'no';
		if($have_scale)
		{
			\lib\app\setting\tools::update('store_setting', 'scale', $have_scale);
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


	public static function save_company($_args)
	{
		\dash\app::variable($_args);

		$companyeconomiccode = \dash\app::request('companyeconomiccode');
		if($companyeconomiccode && !is_numeric($companyeconomiccode))
		{
			\dash\notif::error(T_("Plase fill the field as a number"), 'companyeconomiccode');
			return false;
		}

		if($companyeconomiccode && mb_strlen($companyeconomiccode) > 100)
		{
			\dash\notif::error(T_("Plase fill the value less than 100 character"), 'companyeconomiccode');
			return false;
		}

		$companynationalid = \dash\app::request('companynationalid');
		if($companynationalid && !is_numeric($companynationalid))
		{
			\dash\notif::error(T_("Plase fill the field as a number"), 'companynationalid');
			return false;
		}

		if($companynationalid && mb_strlen($companynationalid) > 100)
		{
			\dash\notif::error(T_("Plase fill the value less than 100 character"), 'companynationalid');
			return false;
		}

		$companyregisternumber = \dash\app::request('companyregisternumber');
		if($companyregisternumber && !is_numeric($companyregisternumber))
		{
			\dash\notif::error(T_("Plase fill the field as a number"), 'companyregisternumber');
			return false;
		}

		if($companyregisternumber && mb_strlen($companyregisternumber) > 100)
		{
			\dash\notif::error(T_("Plase fill the value less than 100 character"), 'companyregisternumber');
			return false;
		}

		$ceonationalcode = \dash\app::request('ceonationalcode');
		if($ceonationalcode && !\dash\utility\filter::nationalcode($ceonationalcode))
		{
			\dash\notif::error(T_("Invalid nationalcode"), 'ceonationalcode');
			return false;
		}

		$companyname = \dash\app::request('companyname');
		if($companyname && mb_strlen($companyname) > 100)
		{
			\dash\notif::error(T_("Plase fill the value less than 100 character"), 'companyname');
			return false;
		}

		$args                          = [];
		$args['companyeconomiccode']   = $companyeconomiccode;
		$args['companynationalid']     = $companynationalid;
		$args['companyregisternumber'] = $companyregisternumber;
		$args['ceonationalcode']       = $ceonationalcode;
		$args['companyname']           = $companyname;

		foreach ($args as $key => $value)
		{
			\lib\app\setting\tools::update('store_setting', $key, $value);
		}

		return true;
	}
}
?>