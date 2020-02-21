<?php
namespace dash\engine\layout\pwa;

class pwa_menu
{
	public static function get()
	{
		if(\dash\url::content())
		{
			return self::primary();
		}
	}


	public static function primary()
	{
		$myFooter =
		[
			'dashboard' =>
			[
				'href' => \dash\url::kingdom(). '/my',
				'selected' => true,
				'icon' => 'gauge',
				'title' => T_('Dashboard'),
			],
			'messages' =>
			[
				'href' => \dash\url::kingdom(). '/account/notification',
				'icon' => 'comments',
				'title' => T_('Messages'),
			],
			'stores' =>
			[
				'href' => \dash\url::kingdom(). '/my/store',
				'icon' => 'money',
				'title' => T_('Stores'),
			],
			'support' =>
			[
				'href' => \dash\url::kingdom(). '/support',
				'icon' => 'info-circle',
				'title' => T_('Help Center'),
			],
			'account' =>
			[
				'href' => \dash\url::kingdom(). '/account',
				'icon' => 'user',
				'title' => T_('Profile'),
			],
		];

		return $myFooter;
	}


	public static function store()
	{
		$myFooter =
		[
			'product' =>
			[
				'href' => \dash\url::kingdom(). '/a/product',
				'selected' => true,
				// 'icon' => 'gauge',
				'title' => T_('product'),
			],
			'orders' =>
			[
				'href' => \dash\url::kingdom(). '/a/order',
				// 'icon' => 'comments',
				'title' => T_('Orders'),
			],
			'reports' =>
			[
				'href' => \dash\url::kingdom(). '/a/report',
				// 'icon' => 'money',
				'title' => T_('Reports'),
			],
			'settings' =>
			[
				'href' => \dash\url::kingdom(). '/a/setting',
				// 'icon' => 'info-circle',
				'title' => T_('Settings'),
			],
		];

		return $myFooter;
	}
}
?>
