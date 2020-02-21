<?php
namespace dash\engine\layout\pwa;

class pwa_menu
{
	public static function get()
	{
		if(\dash\url::content())
		{
			switch (\dash\url::content())
			{
				case 'enter':
					return null;
					break;

				case 'a':
					return self::store();
					break;

				default:
					return self::primary();
					break;
			}
		}
	}


	public static function primary()
	{
		$myFooter =
		[
			'dashboard' =>
			[
				'href' => \dash\url::kingdom(). '/my',
				// 'selected' => true,
				'icon' => 'gauge',
				'title' => T_('Dashboard'),
			],
			'messages' =>
			[
				'href' => \dash\url::kingdom(). '/account/notification',
				'icon' => 'comments',
				'title' => T_('Messages'),
			],
			'store' =>
			[
				'href' => \dash\url::kingdom(). '/my/store',
				'icon' => 'money',
				'title' => T_('Store'),
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

		// select module if user select them
		switch (\dash\url::content())
		{
			case 'account':
				if(\dash\url::module() === 'notification')
				{
					$myFooter['messages']['selected'] = true;
				}
				else
				{
					$myFooter['account']['selected'] = true;
				}
				break;

			case 'support':
				$myFooter['support']['selected'] = true;
				break;

			case 'my':
				if(\dash\url::module() === 'store')
				{
					$myFooter['store']['selected'] = true;
				}
				else
				{
					$myFooter['dashboard']['selected'] = true;
				}
				break;

			default:
				# code...
				break;
		}

		return $myFooter;
	}


	public static function store()
	{
		$myFooter =
		[
			'dashboard' =>
			[
				'href' => \dash\url::kingdom(). '/a',
				'selected' => true,
				'icon' => 'home',
				'title' => T_('Home'),
			],
			'product' =>
			[
				'href' => \dash\url::kingdom(). '/a/products',
				'icon' => 'box',
				'title' => T_('product'),
			],
			'orders' =>
			[
				'href' => \dash\url::kingdom(). '/a/factor',
				'icon' => 'print',
				'title' => T_('Orders'),
			],
			// 'reports' =>
			// [
			// 	'href' => \dash\url::kingdom(). '/a/report',
			// 	'icon' => 'money',
			// 	'title' => T_('Reports'),
			// ],
			'settings' =>
			[
				'href' => \dash\url::kingdom(). '/a/setting',
				'icon' => 'cogs',
				'title' => T_('Settings'),
			],
		];

		return $myFooter;
	}
}
?>
