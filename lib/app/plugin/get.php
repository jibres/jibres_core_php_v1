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
		$list =
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

			'site_options_responsive_footer'


			/*=====  End of Site plugins  ======*/

		];




		// call detail functon of every plugin items
		$plugin  = [];

		foreach ($list as $plugin_key)
		{
			$temp        = \lib\app\plugin\call_function::detail($plugin_key);

			if($temp)
			{
				$temp['plugin_key'] = $plugin_key;
				$plugin[]           =  $temp;
			}
		}


		return $plugin;

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


	public static function all_list_by_count()
	{
		$list         = self::all_list();
		$count_all    = \lib\db\store_plugin\get::group_by_plugin_key();
		$count_enable = \lib\db\store_plugin\get::group_by_plugin_key_status('enable');

		foreach ($list as $key => $value)
		{
			if(isset($value['plugin_key']))
			{
				if(isset($count_all[$value['plugin_key']]))
				{
					$list[$key]['count_use'] = $count_all[$value['plugin_key']];
				}

				if(isset($count_enable[$value['plugin_key']]))
				{
					$list[$key]['count_enable'] = $count_enable[$value['plugin_key']];
				}
			}
		}

		return $list;

	}


	public static function price($_plugin)
	{
		$price = \lib\app\plugin\call_function::price($_plugin);

		if(!$price)
		{
			$price = 0;
		}

		return $price;
	}


	public static function zone($_plugin)
	{
		$zone = \lib\app\plugin\call_function::zone($_plugin);

		if(!$zone)
		{
			$zone = 0;
		}

		return $zone;
	}


	public static function title($_plugin)
	{
		$title = \lib\app\plugin\call_function::title($_plugin);

		return $title;
	}



}
?>