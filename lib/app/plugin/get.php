<?php
namespace lib\app\plugin;


class get
{

	/**
	 * Get list of plugin items
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function all_list()
	{
		/**
		 * After add new plugin file need update this list
		 */
		$keys =
		[

			'sms_pack',

			'ganje_product',

			'admin_domain',

			'remove_brand',

			// /* Discount code */
			'discount_profesional',

			// /* Site blog  */
			// 'site_body_blog_b4',

			// /* Responsive */
			// 'site_options_responsive_footer',

			// // test free plugin
			// 'site_body_blog_free',



			/*=====  End of Site plugins  ======*/

		];

		if(!\dash\url::isLocal())
		{
			unset($keys[array_search('sms_pack', $keys)]);
		}



		// call detail functon of every plugin items
		$list  = [];

		foreach ($keys as $plugin)
		{
			$temp        = \lib\app\plugin\call_function::detail($plugin);

			if($temp)
			{
				$temp['plugin'] = $plugin;
				$list[]       =  $temp;
			}
		}


		return $list;

	}


	/**
	 * Get plugin detail
	 *
	 * @param      <type>  $_plugin  The plugin
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function detail($_plugin)
	{
		return \lib\app\plugin\call_function::detail($_plugin);
	}


	/**
	 * Get price.
	 * If type is once get the price else load all price list and get price of periodic
	 *
	 * @param      <type>  $_plugin    The plugin
	 * @param      <type>  $_periodic  The periodic
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function price($_plugin, $_periodic = null)
	{
		$detail = \lib\app\plugin\call_function::detail($_plugin);

		$price = null;

		if(a($detail, 'type') === 'once')
		{
			$price = a($detail, 'price');
		}
		elseif(a($detail, 'type') === 'counting_package')
		{
			$price = a($detail, 'price');
		}
		else
		{
			if(!$_periodic)
			{
				\dash\notif::error(T_("Please choose one periodic"));
				return false;
			}

			$price_list = a($detail, 'price_list');
			if(!is_array($price_list) || !$price_list)
			{
				\dash\log::oops('ErrorPluginPriceList', T_("Can not complete your request. Please contact to administrator"));
				return false;
			}


			foreach ($price_list as $key => $value)
			{
				if(a($value, 'key') === $_periodic)
				{
					$price = a($value, 'price');
					break;
				}
			}
		}

		return self::payable_price($_plugin, $price);
	}



	public static function in_discount_time($_plugin)
	{
		$load = self::detail($_plugin);

		// force disable auto discount. For example sms_package
		if(a($load, 'disable_auto_discount') === true)
		{
			return false;
		}

		if(a($load, 'relase_date') && (a($load, 'price') || a($load, 'price_list')))
		{
			if(time() - strtotime($load['relase_date']) < (60*60*24*7))
			{
				return true;
			}
		}

		return false;
	}


	public static function payable_price($_plugin, $_price)
	{
		$discount_percent = 0;

		if(self::in_discount_time($_plugin))
		{
			$discount_percent = 90;
		}

		$price = floatval($_price);

		if($discount_percent)
		{
			$price = $price - round(($price * $discount_percent) / 100);
		}

		return $price;
	}


	public static function can_start_new_pay($_is_activated, $_plugin, $_expire_date = null)
	{
		$load = self::detail($_plugin);

		$payable = true;

		if($_is_activated && a($load, 'type') === 'once')
		{
			$payable = false;
		}
		else
		{
			if($_expire_date && a($load, 'max_period'))
			{
				if(strtotime($load['max_period']) < strtotime($_expire_date))
				{
					$payable = false;
				}
			}
		}

		return $payable;
	}



	public static function plus_day($_plugin, $_periodic)
	{
		$detail = \lib\app\plugin\call_function::detail($_plugin);

		$plus_day = null;

		if(a($detail, 'type') === 'once')
		{
			\dash\notif::error(T_("This plugin is not periodically"));
			return false;
		}
		else
		{
			if(!$_periodic)
			{
				\dash\notif::error(T_("Please choose one periodic"));
				return false;
			}

			$price_list = a($detail, 'price_list');
			if(!is_array($price_list) || !$price_list)
			{
				\dash\log::oops('ErrorPluginPriceList', T_("Can not complete your request. Please contact to administrator"));
				return false;
			}


			foreach ($price_list as $key => $value)
			{
				if(a($value, 'key') === $_periodic)
				{
					$plus_day = a($value, 'plus_day');
					break;
				}
			}
		}

		return $plus_day;
	}

	public static function zone($_plugin)
	{
		$detail = \lib\app\plugin\call_function::detail($_plugin);

		$zone = floatval(a($detail, 'zone'));
		if(!$zone || !is_numeric($zone))
		{
			$zone = null;
		}

		if(!$zone)
		{
			$zone = strtok($_plugin, '_');
		}

		return $zone;
	}


	public static function title($_plugin)
	{
		$detail = \lib\app\plugin\call_function::detail($_plugin);

		$title = a($detail, 'title');

		return $title;
	}


	public static function more_detail($_plugin)
	{
		$detail = \lib\app\plugin\call_function::more_detail($_plugin);

		return $detail;
	}


	/**
	 * Convert day to time
	 * 1 day = 86400 second
	 *
	 * @param      <type>  $_days  The days
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function day_to_time($_days)
	{
		return floatval($_days) * 60 * 60 * 24;
	}


}
?>