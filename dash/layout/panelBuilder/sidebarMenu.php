<?php
namespace dash\layout\panelBuilder;

class sidebarMenu
{
	public static function list0()
	{
		$menu =
		[
				"group"     => "list0",
				"nav_class" => 'asideM2',
				'level'     => 0,
				"list"      =>
				[
					"home" =>
					[
						'title'       => T_("Home"),
						'url'         => \dash\url::kingdom().'/a',
						'icon'        => 'home',
						'iconColor'   => '#a1b2c3',
						'class'       => '123',
						// 'selected' => true,
					],
					"orders" =>
					[
						'title'     => T_("Orders"),
						'url'    => \dash\url::kingdom().'/a/orders',
						'icon'      => 'orders',
						'iconColor' => '#a1b2c3',
					],
					"products" =>
					[
						'title'     => T_("Products"),
						'url'       => \dash\url::kingdom().'/a/products',
						'icon'      => 'products',
						'iconColor' => '#a1b2c3',
					],
					"crm" =>
					[
						'title'     => T_("CRM"). ' - '. T_("Customers"),
						'url'       => \dash\url::kingdom().'/crm',
						'icon'      => 'Customers',
						'iconColor' => '#a1b2c3',
					],
					"analytics" =>
					[
						'title'     => T_("Analytics"),
						'url'       => \dash\url::kingdom().'/a/analytics',
						'icon'      => 'analytics',
						'iconColor' => '#a1b2c3',
					],
					"discounts" =>
					[
						'title'     => T_("Discounts"),
						'url'       => \dash\url::kingdom().'/a/discount',
						'icon'      => 'Discounts',
						'child'     => self::list_crm(),
						'iconColor' => '#a1b2c3',
					],
					"plugins" =>
					[
						'title'     => T_("Plugins"),
						'url'       => \dash\url::kingdom().'/a/plugins',
						'icon'      => 'Apps',
						'iconColor' => '#da9e51',
					],
					"seperator1" =>
					[
						'seperator' => true,
						'desc' => 123,
					],
					"channels" =>
					[
						'title'     => T_("Sales Channels"),
					],
					"siteBuilder" =>
					[
						'title'     => T_("Online Website"),
						'url'       => \dash\url::kingdom().'/a/sitebuilder',
						'icon'      => 'Online Store',
						// 'child'     => self::list_crm(),
						'iconColor' => '#a1b2c3',
					],
				],
		];


		switch (\dash\url::content())
		{
			case 'a':
				switch (\dash\url::module())
				{
					case 'discount':
						$menu['list']['discounts']['selected'] = true;
						break;

					case 'null':
						$menu['list']['home']['selected'] = true;
						break;

					default:
						break;
				}
				break;

			default:
				break;
		}

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
