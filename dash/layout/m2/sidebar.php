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
				'selected' => (in_array($module, ['order', 'chap', 'sale']) && $child !== 'unprocessed'),
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

			$orders_child['sale'] =
			[
				'title'    => T_("Add new sale order"),
				'url'      => $kingdom. '/a/sale',
				'selected' => $module === 'sale',
			];

			$orders_child['buy'] =
			[
				'title'    => T_("Add new buy order"),
				'url'      => $kingdom. '/a/buy',
				'selected' => $module === 'buy',
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


		if(in_array($module, ['products', 'category', 'units', 'pricehistory']))
		{
			$menu['products']['iconColor'] = $blue;

			$product_child = [];

			$product_child['all'] =
			[
				'title'    => T_("All products"),
				'url'      => $kingdom. '/a/products',
				'selected' => (in_array($module, ['products', 'pricehistory']) && $child !== 'add'),
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


		if(in_array($content, ['crm']) || ($content === 'a' && $module === 'form'))
		{
			$menu['crm']['iconColor'] = $blue;
			if(!$module)
			{
				$menu['crm']['selected']  = true;
			}

			$crm_child = [];

			$crm_child['all'] =
			[
				'title'    => T_("All customers"),
				'url'      => $kingdom. '/crm/member',
				'selected' => ($content === 'crm' &&  $module === 'member'),
			];

			$crm_child['transactions'] =
			[
				'title'    => T_("Transactions"),
				'url'      => $kingdom. '/crm/transactions',
				'selected' => ($content === 'crm' && $module === 'transactions'),
			];


			$crm_child['form'] =
			[
				'title'    => T_("Form builder"),
				'url'      => $kingdom. '/a/form',
				'selected' => ($content === 'a' && $module === 'form'),
			];


			$crm_child['ticket'] =
			[
				'title'    => T_("Ticket"),
				'url'      => $kingdom. '/crm/ticket',
				'selected' => ($content === 'crm' && $module === 'ticket'),
			];



			$crm_child['permission'] =
			[
				'title'    => T_("Permission"),
				'url'      => $kingdom. '/crm/permission',
				'selected' => ($content === 'crm' && $module === 'permission'),
			];


			$menu['crm']['child'] = $crm_child;
		}

		/*=====  End of CRM  ======*/




		/*===========================
		=            CMS            =
		===========================*/
		if(\dash\permission::check('_group_cms'))
		{
			$menu['cms'] =
			[
				'url'      => $kingdom. '/cms',
				'title'    => T_("Content Management"),
				'icon'      => 'Blog',
				'iconColor' => '#a1b2c3',
			];

		  	if(in_array($content, ['cms']) && $module !== 'files')
			{
				$menu['cms']['iconColor'] = $blue;

				if(!$module)
				{
					$menu['cms']['selected']  = true;
				}

				$cms_child = [];

				$cms_child['posts'] =
				[
					'title'    => T_("Posts"),
					'url'      => $kingdom. '/cms/posts',
					'selected' => ($module === 'posts'),
				];


				$cms_child['hashtag'] =
				[
					'title'    => T_("Hashtag"),
					'url'      => $kingdom. '/cms/hashtag',
					'selected' => ($module === 'hashtag'),
				];

				$cms_child['comments'] =
				[
					'title'    => T_("Comments"),
					'url'      => $kingdom. '/cms/comments',
					'selected' => ($module === 'comments'),
				];


				$menu['cms']['child'] = $cms_child;
			}
		}
		/*=====  End of CMS  ======*/


		/*=============================
		=            Files            =
		=============================*/
		if(\dash\permission::check('cmsAttachmentView'))
		{

			$menu['files'] =
			[
				'url'      => $kingdom. '/cms/files',
				'title'    => T_("Files"),
				'icon'      => 'Attachment',
			];

		  	if(in_array($content, ['cms']) && $module === 'files')
			{
				$menu['files']['iconColor'] = $blue;
				$menu['files']['selected'] = true;
			}
		}


		/*=====  End of Files  ======*/


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

			if(!$child)
			{
				$menu['analytics']['selected']  = true;
			}

			$analytics_child = [];

			$analytics_child['sale'] =
			[
				'title'    => T_("Sale report"),
				'url'      => $kingdom. '/a/report/sale',
				'selected' => ($child === 'sale'),
			];

			$analytics_child['products'] =
			[
				'title'    => T_("Products report"),
				'url'      => $kingdom. '/a/report/products',
				'selected' => ($child === 'products'),
			];


			$menu['analytics']['child'] = $analytics_child;


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

		if(in_array($module, ['setting']) && !($content === 'a' && $module === 'setting' && in_array($child, ['domain', 'menu'])))
		{
			$menu['settings']['iconColor'] = $blue;
			$menu['settings']['selected']  = true;
		}

		/*=====  End of Setting  ======*/





		/*=================================
		=            Seperator            =
		=================================*/
		$menu["seperator1"] =
		[
			'seperator' => true,
			// 'desc'      => 123,
		];

		$menu["channels"] =
		[
			'title'     => T_("Sales Channels"),
		];


		/*=====  End of Seperator  ======*/






		/*===================================
		=            SiteBuilder            =
		===================================*/
		$menu["site"] =
		[
			'title'     => T_("Online Website"),
			'url'       => \dash\url::kingdom().'/site',
			'icon'      => 'Online Store',
			'iconColor' => 'green',
		];

		if(in_array($content, ['site',]) || ($content === 'a' && $module === 'setting' && in_array($child, ['domain', 'menu'])))
		{
			$menu['site']['iconColor'] = $blue;
			// $menu['site']['selected']  = true;

			$sidebar_links = [];

			$sidebar_links[] =
			[
				'url'      => $kingdom. '/site',
				'title'    => T_("Site builder"),
				// 'icon'  => 'Note',
				'direct'   => true,
				'selected' => ($content === 'site' && !in_array($module, ['sitemap', 'staticfile', 'autosave']))
			];

			if(\dash\permission::check('siteBuilderSetting'))
			{
			  $sidebar_links[] =
			  [
				'url'      => $kingdom. '/a/setting/domain',
				'title'    => T_("domain"),
				// 'icon'  => 'Domains',
				'direct'   => true,
				'selected' => ($content === 'a' && $module === 'setting' && $child === 'domain')
			  ];

			}

			$sidebar_links[] =
			[
				'url'      => $kingdom. '/site/sitemap',
				'title'    => T_("Sitemap"),
				// 'icon'  => 'Globe',
				'direct'   => false,
				'selected' => ($module === 'sitemap'),
			];



			if(\dash\permission::check('siteBuilderSetting'))
			{
			  $sidebar_links[] =
			  [
				'url'      => $kingdom. '/site/staticfile',
				'title'    => T_("Static file"),
				// 'icon'  => 'Tools',
				'direct'   => false,
				'selected' => ($module === 'staticfile'),
			  ];
			}




			$sidebar_links[] =
			[
				'url'     => $kingdom. '/a/setting/menu',
				'title'   => T_("Menu"),
				// 'icon' => 'MobileHamburger',
				'direct'  => true,
				'selected' => ($content === 'a' && $module === 'setting' && $child === 'menu')
			];

			if(\dash\permission::check('siteBuilderSetting'))
			{
			  $sidebar_links[] =
			  [
				'url'      => $kingdom. '/site/autosave',
				'title'    => T_("Setting auto-save and publish"),
				// 'icon'  => 'FlipCamera',
				'direct'   => false,
				'selected' => ($module === 'autosave'),
			  ];
			}



			$menu['site']['child'] = $sidebar_links;
		}

		/*=====  End of SiteBuilder  ======*/





		/*===================================
		=            Application            =
		===================================*/
		$menu["android"] =
		[
			'title'     => T_("Mobile App"),
			'url'       => \dash\url::kingdom().'/a/android',
			'icon'      => 'mobile',
			'iconColor' => '#a1b2c3',
		];

		if(in_array($module, ['android']))
		{
			$menu['android']['iconColor'] = $blue;
			$menu['android']['selected']  = true;
		}

		/*=====  End of Application  ======*/






		// $menu["pos"] =
		// [
		// 	'title'     => T_("Point of Sale"),
		// 	'url'       => \dash\url::kingdom().'/a/pos',
		// 	'icon'      => 'point of sale',
		// 	'iconColor' => '#a1b2c3',
		// ];






		if(\dash\url::isLocal())
		{

			$menu["seperator2"] =
			[
				'seperator' => true,
				'desc' => 123,
			];

			$menu["plugins"] =
			[
				'title'     => T_("Plugins"),
				'url'       => \dash\url::kingdom().'/a/plugin',
				'icon'      => 'Apps',
				'iconColor' => '#da9e51',
			];
		}




		return $menu;
	}

}
?>