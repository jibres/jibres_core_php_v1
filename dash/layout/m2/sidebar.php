<?php
namespace dash\layout\m2;

class sidebar
{
	/**
	 * Generate html of sidebar menu
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function html()
	{
		// generate html of sidebar
		$sidebar_menu = self::sidebar_menu();

		$sidebar_menu =
		[
			"group"     => "list0",
			"nav_class" => 'asideM2',
			'level'     => 0,
			"list"      => $sidebar_menu,
		];

		// generate menu
		$html = \content_site\assemble\menu::generate(null, $sidebar_menu);

		return $html;
	}


	/**
	 * Generate menu items
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	private static function sidebar_menu()
	{
		$menu = [];

		/*========================================
		=            Home / Dashboard            =
		========================================*/
		$menu['home'] =
		[
			'title'     => T_("Dashboard"),
			'url'       => \dash\url::kingdom().'/a',
			'icon'      => 'home',
			'iconColor' => '#a1b2c3',
			'class'     => null,
			'selected'  => false,
		];

		if(!\dash\url::module())
		{
			$menu['home']['selected'] = true;
		}
		/*=====  End of Home / Dashboard  ======*/


		/*==============================
		=            Orders            =
		==============================*/
		$menu["orders"] =
		[
			'title'     => T_("Orders"),
			'url'       => \dash\url::kingdom().'/a/order',
			'icon'      => 'orders',
			'iconColor' => '#a1b2c3',
			'class'     => null,
			'selected'  => false,
		];

		if(\dash\url::module() === 'order')
		{
			$menu['orders']['selected'] = true;


			$orders_child = [];

			$orders_child['all_orders'] =
			[
				'title'    => T_("All orders"),
				'url'      => \dash\url::this(),
				'selected' => null,
			];

			if(!\dash\url::child())
			{
				$orders_child['all_orders']['selected'] = true;
				$menu['orders']['selected']             = false;
			}

			$menu['orders']['child'] = $orders_child;

		}


		/*=====  End of Orders  ======*/


		/*================================
		=            Products            =
		================================*/
		$menu["products"] =
		[
			'title'     => T_("Products"),
			'url'       => \dash\url::kingdom().'/a/products',
			'icon'      => 'products',
			'iconColor' => '#a1b2c3',
			'selected'  => null,
		];


		if(\dash\url::module() === 'products')
		{
			$menu['products']['selected'] = true;


			$product_child = [];

			$product_child['all_products'] =
			[
				'title'    => T_("All orders"),
				'url'      => \dash\url::this(),
				'selected' => null,
			];

			if(!\dash\url::child())
			{
				$product_child['all_products']['selected'] = true;
				$menu['products']['selected']             = false;
			}

			$menu['products']['child'] = $product_child;

		}





		/*=====  End of Products  ======*/


		$menu["crm"] =
		[
			'title'     => T_("CRM"). ' - '. T_("Customers"),
			'url'       => \dash\url::kingdom().'/crm',
			'icon'      => 'Customers',
			'iconColor' => '#a1b2c3',
		];

		$menu["analytics"] =
		[
			'title'     => T_("Analytics"),
			'url'       => \dash\url::kingdom().'/a/analytics',
			'icon'      => 'analytics',
			'iconColor' => '#a1b2c3',
		];


		$menu["discounts"] =
		[
			'title'     => T_("Discounts"),
			'url'       => \dash\url::kingdom().'/a/discount',
			'icon'      => 'Discounts',
			'child'     => self::list_crm(),
			'iconColor' => '#a1b2c3',
		];


		$menu["settings"] =
		[
			'title'     => T_("Settings"),
			'url'       => \dash\url::kingdom().'/a/settings',
			'icon'      => 'Settings',
			'iconColor' => '#a1b2c3',
		];

		$menu["seperator1"] =
		[
			'seperator' => true,
			// 'desc'      => 123,
		];

		$menu["channels"] =
		[
			'title'     => T_("Sales Channels"),
		];


		$menu["siteBuilder"] =
		[
			'title'     => T_("Online Website"),
			'url'       => \dash\url::kingdom().'/a/sitebuilder',
			'icon'      => 'Online Store',
			'child'     => self::list_crm(),
			'iconColor' => 'green',
		];


		$menu["android"] =
		[
			'title'     => T_("Mobile App"),
			'url'       => \dash\url::kingdom().'/a/pos',
			'icon'      => 'mobile',
			'iconColor' => '#a1b2c3',
		];


		$menu["pos"] =
		[
			'title'     => T_("Point of Sale"),
			'url'       => \dash\url::kingdom().'/a/pos',
			'icon'      => 'point of sale',
			'iconColor' => '#a1b2c3',
		];


		$menu["seperator2"] =
		[
			'seperator' => true,
			'desc' => 123,
		];


		$menu["plugins"] =
		[
			'title'     => T_("Plugins"),
			'url'       => \dash\url::kingdom().'/a/plugins',
			'icon'      => 'Apps',
			'iconColor' => '#da9e51',
		];



		// switch (\dash\url::content())
		// {
		// 	case 'a':
		// 		switch (\dash\url::module())
		// 		{
		// 			case 'discount':
		// 				$menu['list']['discounts']['selected'] = true;
		// 				break;

		// 			case 'null':
		// 				$menu['list']['home']['selected'] = true;
		// 				break;
		// 			case 'products':
		// 				$menu['list']['home']['selected'] = true;

		// 			default:
		// 				break;
		// 		}
		// 		break;

		// 	default:
		// 		break;
		// }

		return $menu;
	}


	public static function list_crm()
	{
		$menu =
		[
				"crm_home" =>
				[
					'title' => T_("Test1"),
					'url' => \dash\url::kingdom().'/a',
				],
				"crm_home2" =>
				[
					'title' => T_("Test2"),
					'url' => \dash\url::kingdom().'/a/orders',
				],
		];

		return $menu;
	}
}
?>