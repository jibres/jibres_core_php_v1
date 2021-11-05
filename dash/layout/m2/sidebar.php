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
		/**
		 * Define
		 */
		$menu    = [];
		$kingdom = \dash\url::kingdom();
		$content = \dash\url::content();
		$module  = \dash\url::module();
		$child   = \dash\url::child();
		$blue    = '#009ef7';


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

		if($content === 'a' && !$module)
		{
			$menu['home']['selected'] = true;
			$menu['home']['iconColor'] = $blue;
		}
		/*=====  End of Home / Dashboard  ======*/


		/*==============================
		=            Orders            =
		==============================*/
		$menu["orders"] =
		[
			'title'     => T_("Orders"),
			'url'       => $kingdom. '/a/order',
			'icon'      => 'orders',
			'iconColor' => '#a1b2c3',
			'class'     => null,
			'selected'  => false,
		];

		if(in_array($module, ['order', 'cart', 'sale', 'chap']))
		{
			$menu['orders']['iconColor'] = $blue;

			$orders_child = [];

			$orders_child['all'] =
			[
				'title'    => T_("All orders"),
				'url'      => $kingdom. '/a/order',
				'selected' => (in_array($module, ['order', 'chap']) && $child !== 'unprocessed'),
			];

			$orders_child['unprocessed'] =
			[
				'title'    => T_("Unprocessed Order"),
				'url'      => $kingdom. '/a/order/unprocessed',
				'selected' => $child === 'unprocessed',
			];

			$orders_child['cart'] =
			[
				'title'    => T_("Cart"),
				'url'      => $kingdom. '/a/cart',
				'selected' => $module === 'cart',
			];


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


		if(in_array($module, ['products', 'category', 'units']))
		{
			$menu['products']['iconColor'] = $blue;

			$product_child = [];

			$product_child['all'] =
			[
				'title'    => T_("All products"),
				'url'      => $kingdom. '/a/products',
				'selected' => ($module === 'products' && $child !== 'add'),
			];


			$product_child['add'] =
			[
				'title'    => T_("Add product"),
				'url'      => $kingdom. '/a/products/add',
				'selected' => ($child === 'add'),
			];

			$product_child['category'] =
			[
				'title'    => T_("Category"),
				'url'      => $kingdom. '/a/category',
				'selected' => ($module === 'category'),
			];

			$product_child['units'] =
			[
				'title'    => T_("Units"),
				'url'      => $kingdom. '/a/units',
				'selected' => ($module === 'units'),
			];

			$menu['products']['child'] = $product_child;
		}
		/*=====  End of Products  ======*/


		/*===========================
		=            CRM            =
		===========================*/
		$menu["crm"] =
		[
			'title'     => "CRM". ' - '. T_("Customers"),
			'url'       => $kingdom. '/crm',
			'icon'      => 'Customers',
			'iconColor' => '#a1b2c3',
		];


		if(in_array($content, ['crm']))
		{
			$menu['crm']['iconColor'] = $blue;
			$menu['crm']['selected']  = true;

			$crm_child = [];

			$crm_child['all'] =
			[
				'title'    => T_("All customers"),
				'url'      => $kingdom. '/crm/member',
				'selected' => ($content === 'crm'),
			];

			$crm_child['add'] =
			[
				'title'    => T_("All new customer"),
				'url'      => $kingdom. '/crm/member/add',
				'selected' => ($content === 'crm'),
			];

			$menu['crm']['child'] = $crm_child;
		}

		/*=====  End of CRM  ======*/


		/*=================================
		=            Analytics            =
		=================================*/
		$menu["analytics"] =
		[
			'title'     => T_("Analytics"),
			'url'       => \dash\url::kingdom().'/a/report',
			'icon'      => 'analytics',
			'iconColor' => '#a1b2c3',
		];

		if(in_array($module, ['report']))
		{
			$menu['analytics']['iconColor'] = $blue;
			$menu['analytics']['selected']  = true;
		}

		/*=====  End of Analytics  ======*/


		/*================================
		=            Discount            =
		================================*/
		if(\dash\url::isLocal())
		{
			$menu["discounts"] =
			[
				'title'     => T_("Discounts"),
				'url'       => \dash\url::kingdom().'/a/discount',
				'icon'      => 'Discounts',
				'iconColor' => '#a1b2c3',
			];

			if(in_array($module, ['discount']))
			{
				$menu['discounts']['iconColor'] = $blue;
				$menu['discounts']['selected']  = true;
			}
		}



		/*=====  End of Discount  ======*/


		/*===============================
		=            Setting            =
		===============================*/
		$menu["settings"] =
		[
			'title'     => T_("Settings"),
			'url'       => \dash\url::kingdom().'/a/setting',
			'icon'      => 'Settings',
			'iconColor' => '#a1b2c3',
		];

		if(in_array($module, ['setting']))
		{
			$menu['settings']['iconColor'] = $blue;
			$menu['settings']['selected']  = true;
		}

		/*=====  End of Setting  ======*/


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