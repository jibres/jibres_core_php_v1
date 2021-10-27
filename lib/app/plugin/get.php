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

			'site_options_responsive_footer'


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


	public static function all_list_by_count()
	{
		$list         = self::all_list();
		$count_all    = \lib\db\store_plugin\get::group_by_plugin();
		$count_enable = \lib\db\store_plugin\get::group_by_plugin_status('enable');

		foreach ($list as $key => $value)
		{
			if(isset($value['plugin']))
			{
				if(isset($count_all[$value['plugin']]))
				{
					$list[$key]['count_use'] = $count_all[$value['plugin']];
				}

				if(isset($count_enable[$value['plugin']]))
				{
					$list[$key]['count_enable'] = $count_enable[$value['plugin']];
				}
			}
		}

		return $list;

	}


	public static function price($_plugin)
	{
		$detail = \lib\app\plugin\call_function::detail($_plugin);

		$price = floatval(a($detail, 'price'));
		if(!$price || !is_numeric($price))
		{
			$price = 0;
		}

		return $price;
	}


	public static function zone($_plugin)
	{
		$detail = \lib\app\plugin\call_function::detail($_plugin);

		$zone = floatval(a($detail, 'zone'));
		if(!$zone || !is_numeric($zone))
		{
			$zone = null;
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