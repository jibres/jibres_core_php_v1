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


	public static function ready($_module, $_return = false)
	{
		if(in_array($_module, self::$levels))
		{
			$current_step = array_search($_module, self::$levels) + 1;
			$all = count(self::$levels);
			// set stepDesc
			$stepDesc = T_('Step') . ' ';
			$stepDesc .= \dash\fit::number($current_step). ' ';
			$stepDesc .= T_('of') . ' ';
			$stepDesc .= \dash\fit::number($all);
			\dash\data::stepDesc($stepDesc);
		}

		$store_data = \lib\store::detail('store_data');

		if($_return)
		{
			return $store_data;
		}
		else
		{
			\dash\data::dataRow($store_data);
		}
	}


	public static function save_pos($_args)
	{
		$condition =
		[
			'barcode' => 'bit',
			'scale'   => 'bit',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return self::multi_save($data, 'pos');
	}


	public static function save_payment($_args)
	{
		$condition =
		[
			'payment_online'     => 'bit',
			'payment_check'      => 'bit',
			'payment_bank'       => 'bit',
			'payment_on_deliver' => 'bit',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return self::multi_save($data, 'payment');

	}

	public static function save_vat($_args)
	{
		$condition =
		[
			'tax_status'         => 'bit',
			'tax_calc'           => 'bit',
			'tax_calc_all_price' => 'bit',
			'tax_shipping'       => 'bit',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return self::multi_save($data, 'vat');

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
			\lib\app\store\edit::selfedit(['logo' => $file]);
		}
		return true;
	}


	public static function save_address($_args)
	{
		$condition =
		[
			'country'  => 'country',
			'province' => 'province',
			'city'     => 'city',
			'address'  => 'address',
			'mobile'   => 'mobile',
			'postcode' => 'postcode',
			'phone'    => 'phone',
			'fax'      => 'phone',

		];

		$require = ['country', 'address'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data['country'] === 'IR' && !$data['province'])
		{
			\dash\notif::error(T_("Please choose your province"), 'province');
			return false;
		}

		if($data['country'] === 'IR' && !$data['city'])
		{
			\dash\notif::error(T_("Please choose your city"), 'city');
			return false;
		}

		return self::multi_save($data, 'address');
	}


	public static function save_company($_args)
	{
		$condition =
		[
			'companyeconomiccode'   => 'bigint',
			'companynationalid'     => 'bigint',
			'companyregisternumber' => 'bigint',
			'ceonationalcode'       => 'nationalcode',
			'companyname'           => 'string_100',
		];

		$require = [];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return self::multi_save($data, 'company');
	}


	public static function save_units($_args)
	{
		$condition =
		[
			'currency'    => ['enum' => array_keys(\lib\currency::list())],
			'length_unit' => ['enum' => array_keys(\lib\units::length())],
			'mass_unit'   => ['enum' => array_keys(\lib\units::mass())],
		];

		$require = ['currency', 'length_unit', 'mass_unit'];

		$meta =	['field_title' => ['length_unit' => T_("Length unit"), 'mass_unit' => T_("Mass unit")]];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		return self::multi_save($data, 'units');
	}
}
?>
