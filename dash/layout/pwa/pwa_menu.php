<?php
namespace dash\layout\pwa;

class pwa_menu
{
	public static function get()
	{
		$myContent = \dash\engine\content::get_name();
		if($myContent)
		{
			switch ($myContent)
			{
				case 'enter':
					return null;
					break;

				case 'a':
					return self::businessAdmin();
					break;

				case 'business':
					switch (\dash\url::module())
					{
						case 'p':
						return self::businessProductPage();
						break;

						default:
						return self::businessWebsite();
						break;
					}
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
			'business' =>
			[
				'href' => \dash\url::kingdom(). '/my/business',
				'icon' => 'money',
				'title' => T_('Business'),
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
				if(\dash\url::module() === 'business')
				{
					$myFooter['business']['selected'] = true;
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


	public static function businessAdmin()
	{
		$myFooter =
		[
			'home' =>
			[
				'href' => \dash\url::kingdom(). '/a',
				'icon' => 'home',
				'title' => T_('Home'),
			],
			'products' =>
			[
				'href' => \dash\url::kingdom(). '/a/products',
				'icon' => 'box',
				'title' => T_('products'),
			],
			'orders' =>
			[
				'href' => \dash\url::kingdom(). '/a/factor',
				'icon' => 'print',
				'title' => T_('Orders'),
			],
			// 'report' =>
			// [
			// 	'href' => \dash\url::kingdom(). '/a/report',
			// 	'icon' => 'money',
			// 	'title' => T_('Report'),
			// ],
			'setting' =>
			[
				'href' => \dash\url::kingdom(). '/a/setting',
				'icon' => 'cogs',
				'title' => T_('Setting'),
			],
		];

		// select module if user select them
		switch (\dash\url::module())
		{
			case 'products':
				$myFooter['products']['selected'] = true;
				break;

			case 'factor':
				$myFooter['orders']['selected'] = true;
				break;

			case 'report':
				$myFooter['reports']['selected'] = true;
				break;

			case 'setting':
				$myFooter['setting']['selected'] = true;
				break;

			default:
				$myFooter['home']['selected'] = true;
				break;
		}

		return $myFooter;
	}


	public static function businessWebsite()
	{
		$myFooter =
		[
			'home' =>
			[
				'href' => \dash\url::kingdom(),
				'icon' => 'home',
				'title' => T_('Home'),
			],
			'category' =>
			[
				'href' => \dash\url::kingdom(). '/category',
				'icon' => 'th-large',
				'title' => T_('Category'),
			],
			'cart' =>
			[
				'href' => \dash\url::kingdom(). '/cart',
				'icon' => 'shopping-cart',
				'title' => T_('Cart'),
				'cartItem' => '3',
			],
			'profile' =>
			[
				'href' => \dash\url::kingdom(). '/profile',
				'icon' => 'user',
				'title' => T_('Profile'),
			],
		];

		// select module if user select them
		switch (\dash\url::module())
		{
			case 'category':
				$myFooter['category']['selected'] = true;
				break;

			case 'cart':
				$myFooter['cart']['selected'] = true;
				break;

			case 'profile':
				$myFooter['profile']['selected'] = true;
				break;

			default:
				$myFooter['home']['selected'] = true;
				break;
		}

		return $myFooter;
	}


	public static function businessProductPage()
	{
		$myFooter =	[];
		if(\dash\data::dataRow_allow_shop())
		{
			$myFooter =
			[
				'cart' =>
				[
					'href' => \dash\url::that(). '?cart',
					'title' => T_('Add to cart'),
					'class' => 'pwafooterAddToCart',
				],
			];
		}
		if(\dash\data::productInCart())
		{
			$myFooter =
			[
				'cart' =>
				[
					'href' => \dash\url::kingdom(). '/cart',
					'title' => T_('In cart'),
					'class' => 'pwafooterGoToCart',
				],
			];
		}

		return $myFooter;
	}

}
?>
