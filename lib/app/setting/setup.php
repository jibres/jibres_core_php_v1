<?php
namespace lib\app\setting;


class setup
{
	private static $setting_cat = 'setup';
	private static $is_end_level = false;

	private static $levels =
	[
		'owner',
		'logo',
		'address',
		'company',
		'units',
		'pos',
		'vat',
		'shipping',
		'payment',

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
				self::$is_end_level = true;
				return \dash\url::here();
			}

		}
	}

	private static function multi_save($_args, $_current_level)
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		foreach ($_args as $key => $value)
		{
			\lib\app\setting\tools::update('store_setting', $key, $value);
		}

		\lib\store::refresh();

		if(\dash\url::module() === 'setup')
		{
			$next_level = self::$_current_level();

			if(self::$is_end_level)
			{
				\dash\notif::direct();
			}

			if($next_level)
			{
				\dash\redirect::to($next_level);
			}
		}
		else
		{
			\dash\notif::ok(T_("Your setting was saved"));
		}

		return true;
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

		$store_data = \lib\store::detail('store_data');
		\dash\data::dataRow($store_data);
	}


	public static function save_pos($_args)
	{
		\dash\app::variable($_args);


		$barcode = \dash\app::request('barcode') ? 1 : null;
		$scale   = \dash\app::request('scale') ? 1 : null;

		$args            = [];
		$args['barcode'] = $barcode;
		$args['scale']   = $scale;

		return self::multi_save($args, 'pos');
	}


	public static function save_payment($_args)
	{
		\dash\app::variable($_args);

		$payment_online     = \dash\app::request('payment_online') ? 1 : null;
		$payment_check     = \dash\app::request('payment_check') ? 1 : null;
		$payment_bank       = \dash\app::request('payment_bank') ? 1 : null;
		$payment_on_deliver = \dash\app::request('payment_on_deliver') ? 1 : null;

		$args                       = [];
		$args['payment_online']     = $payment_online;
		$args['payment_check']     = $payment_check;
		$args['payment_bank']       = $payment_bank;
		$args['payment_on_deliver'] = $payment_on_deliver;

		return self::multi_save($args, 'payment');

	}

	public static function save_vat($_args)
	{
		\dash\app::variable($_args);

		$tax_status         = \dash\app::request('tax_status') ? 1 : null;
		$tax_calc           = \dash\app::request('tax_calc') ? 1 : null;
		$tax_calc_all_price = \dash\app::request('tax_calc_all_price') ? 1 : null;
		$tax_shipping       = \dash\app::request('tax_shipping') ? 1 : null;

		$args                       = [];
		$args['tax_status']         = $tax_status;
		$args['tax_calc']           = $tax_calc;
		$args['tax_calc_all_price'] = $tax_calc_all_price;
		$args['tax_shipping']       = $tax_shipping;

		return self::multi_save($args, 'vat');

	}


	public static function save_shipping($_args)
	{
		\dash\app::variable($_args);

		$shipping_status                     = \dash\app::request('shipping_status') ? 1 : null;
		$shipping_current_country            = \dash\app::request('shipping_current_country') ? 1 : null;
		$shipping_current_country_value      = \dash\app::request('shipping_current_country_value');
		$shipping_current_country_value_type = \dash\app::request('shipping_current_country_value_type');
		$shipping_other_country              = \dash\app::request('shipping_other_country') ? 1 : null;
		$shipping_other_country_value        = \dash\app::request('shipping_other_country_value');
		$shipping_other_country_value_type   = \dash\app::request('shipping_other_country_value_type');

		if($shipping_current_country_value_type === 'free')
		{
			$shipping_current_country_value = 0;
		}
		else
		{
			if($shipping_current_country_value && !\dash\number::is($shipping_current_country_value))
			{
				\dash\notif::error(T_("Invalid number data"), 'shipping_current_country_value');
				return false;
			}

			if($shipping_current_country_value)
			{
				$shipping_current_country_value = \dash\number::clean($shipping_current_country_value);
				if(\dash\number::is_larger($shipping_current_country_value, 999999999999))
				{
					\dash\notif::error(T_("Data is out of range"), 'shipping_current_country_value');
					return false;
				}
			}
		}

		if($shipping_other_country_value_type === 'free')
		{
			$shipping_other_country_value = 0;
		}
		else
		{
			if($shipping_other_country_value && !\dash\number::is($shipping_other_country_value))
			{
				\dash\notif::error(T_("Invalid number data"), 'shipping_other_country_value');
				return false;
			}

			if($shipping_other_country_value)
			{
				$shipping_other_country_value = \dash\number::clean($shipping_other_country_value);
				if(\dash\number::is_larger($shipping_other_country_value, 999999999999))
				{
					\dash\notif::error(T_("Data is out of range"), 'shipping_other_country_value');
					return false;
				}
			}
		}


		$args                                   = [];
		$args['shipping_status']                = $shipping_status;
		$args['shipping_current_country']       = $shipping_current_country;
		$args['shipping_current_country_value'] = $shipping_current_country_value;
		$args['shipping_other_country']         = $shipping_other_country;
		$args['shipping_other_country_value']   = $shipping_other_country_value;


		return self::multi_save($args, 'shipping');
	}



	/**
	 * Uploads a logo.
	 * call from setting upload logo and setup upload logo
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function upload_logo()
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$file = \dash\upload\store_logo::set();

		$old_logo = \lib\app\setting\tools::get('store_setting', 'logo');

		if(!$file && !$old_logo)
		{
			\dash\notif::error(T_("Please choose yoru file"), 'loog');
			return false;
		}

		if($file)
		{
			\lib\app\store\edit::logo($file);
		}
		return true;
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

		if(!$country)
		{
			\dash\notif::error(T_("Please choose your country"), 'country');
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

		if($country === 'IR' && !$province)
		{
			\dash\notif::error(T_("Please choose your province"), 'province');
			return false;
		}

		if($country === 'IR' && !$city)
		{
			\dash\notif::error(T_("Please choose your city"), 'city');
			return false;
		}

		$address = \dash\app::request('address');
		if($address && mb_strlen($address) > 300)
		{
			\dash\notif::error(T_("Please set address less than 300 character"), 'address');
			return false;
		}

		if(!$address)
		{
			\dash\notif::error(T_("Please fill your address"), 'address');
			return false;
		}

		if(mb_strlen($address) < 5)
		{
			\dash\notif::error(T_("This address is too short. Please enter your full address"), 'address');
			return false;
		}


		$mobile = \dash\app::request('mobile');
		$module = \dash\number::clean($mobile);
		if($mobile && !\dash\utility\filter::mobile($mobile))
		{
			\dash\notif::error(T_("Invalid mobile"), 'mobile');
			return false;
		}


		$postcode = \dash\app::request('postcode');
		$postcode = \dash\number::clean($postcode);
		if($postcode && mb_strlen($postcode) > 50)
		{
			\dash\notif::error(T_("Please set postcode less than 50 character"), 'postcode');
			return false;
		}

		if(!$postcode)
		{
			\dash\notif::error(T_("Please set your postcode"), 'postcode');
			return false;
		}

		$phone = \dash\app::request('phone');
		$phone = \dash\number::clean($phone);
		if($phone && mb_strlen($phone) > 50)
		{
			\dash\notif::error(T_("Please set phone less than 50 character"), 'phone');
			return false;
		}


		$fax = \dash\app::request('fax');
		$fax = \dash\number::clean($fax);
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

		return self::multi_save($args, 'address');

	}


	public static function save_company($_args)
	{
		\dash\app::variable($_args);

		$companyeconomiccode = \dash\app::request('companyeconomiccode');
		$companyeconomiccode = \dash\number::clean($companyeconomiccode);
		if($companyeconomiccode && !is_numeric($companyeconomiccode))
		{
			\dash\notif::error(T_("Please fill the field as a number"), 'companyeconomiccode');
			return false;
		}

		if($companyeconomiccode && mb_strlen($companyeconomiccode) > 100)
		{
			\dash\notif::error(T_("Please fill the value less than 100 character"), 'companyeconomiccode');
			return false;
		}

		$companynationalid = \dash\app::request('companynationalid');
		$companynationalid = \dash\number::clean($companynationalid);
		if($companynationalid && !is_numeric($companynationalid))
		{
			\dash\notif::error(T_("Please fill the field as a number"), 'companynationalid');
			return false;
		}

		if($companynationalid && mb_strlen($companynationalid) > 100)
		{
			\dash\notif::error(T_("Please fill the value less than 100 character"), 'companynationalid');
			return false;
		}

		$companyregisternumber = \dash\app::request('companyregisternumber');
		$companyregisternumber = \dash\number::clean($companyregisternumber);
		if($companyregisternumber && !is_numeric($companyregisternumber))
		{
			\dash\notif::error(T_("Please fill the field as a number"), 'companyregisternumber');
			return false;
		}

		if($companyregisternumber && mb_strlen($companyregisternumber) > 100)
		{
			\dash\notif::error(T_("Please fill the value less than 100 character"), 'companyregisternumber');
			return false;
		}

		$ceonationalcode = \dash\app::request('ceonationalcode');
		$ceonationalcode = \dash\number::clean($ceonationalcode);
		if($ceonationalcode && !\dash\utility\filter::nationalcode($ceonationalcode))
		{
			\dash\notif::error(T_("Invalid nationalcode"), 'ceonationalcode');
			return false;
		}

		$companyname = \dash\app::request('companyname');
		if($companyname && mb_strlen($companyname) > 100)
		{
			\dash\notif::error(T_("Please fill the value less than 100 character"), 'companyname');
			return false;
		}

		$args                          = [];
		$args['companyeconomiccode']   = $companyeconomiccode;
		$args['companynationalid']     = $companynationalid;
		$args['companyregisternumber'] = $companyregisternumber;
		$args['ceonationalcode']       = $ceonationalcode;
		$args['companyname']           = $companyname;

		return self::multi_save($args, 'company');
	}


	public static function save_units($_args)
	{
		\dash\app::variable($_args);

		$currency = \dash\app::request('currency');

		if($currency && !in_array($currency, array_keys(\lib\currency::list())))
		{
			\dash\notif::error(T_("Invalid currency"), 'currency');
			return false;
		}

		if(!$currency)
		{
			\dash\notif::error(T_("Please set your currency"), 'currency');
			return false;
		}

		$length_unit         = \dash\app::request('length_unit');
		if($length_unit && !in_array($length_unit, array_keys(\lib\units::length())))
		{
			\dash\notif::error(T_("Invalid length"), 'length_unit');
			return false;
		}

		if(!$length_unit)
		{
			\dash\notif::error(T_("Please set your length unit"), 'length_unit');
			return false;
		}

		$mass_unit         = \dash\app::request('mass_unit');
		if($mass_unit && !in_array($mass_unit, array_keys(\lib\units::mass())))
		{
			\dash\notif::error(T_("Invalid mass"), 'mass_unit');
			return false;
		}

		if(!$mass_unit)
		{
			\dash\notif::error(T_("Please set your mass unit"), 'mass_unit');
			return false;
		}


		$args                = [];
		$args['currency']    = $currency;
		$args['length_unit'] = $length_unit;
		$args['mass_unit']   = $mass_unit;


		return self::multi_save($args, 'units');
	}
}
?>
