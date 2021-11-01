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
			/*=====================================
			=            Admin plugins            =
			=====================================*/

			/* Discount code */
			'discount_profesional',


			/*=====  End of Admin plugins  ======*/


			/*====================================
			=            Site plugins            =
			====================================*/

			/* Site blog  */

			'site_body_blog_b4',

			/* Responsive */

			'site_options_responsive_footer',

			// test free plugin
			'site_body_blog_free',

			// test period plugin
			'remove_brand',


			/*=====  End of Site plugins  ======*/

		];




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

		return $price;
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

		$title = floatval(a($detail, 'title'));
		if(!$title || !is_numeric($title))
		{
			$title = null;
		}

		return $title;
	}



}
?>