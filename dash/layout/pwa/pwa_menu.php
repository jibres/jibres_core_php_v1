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
				case 'site':
				case 'enter':
				case 'pay':
				case 'hook':
				case 'su':
					return null;
					break;

				case 'my':
				case 'account':
				case 'support':
					return self::primary();
					break;

				case 'a':
				case 'crm':
					return self::businessAdmin();
					break;

				case 'business':
					return self::businessWebsiteMenu();
					break;


				default:
					break;
			}
		}
	}

	public static function businessWebsiteMenu()
	{
		switch (\dash\url::module())
		{
			case 'p':
				return self::businessProductPage();
				break;

			case 'cart':
				return self::businessCartPage();
				break;

			case 'shipping':
				return self::businessShippingPage();
				break;

			case 'app':
				// don't show menu on app page
				return null;
			break;

			default:
			case null:
				return self::businessWebsite();
				break;

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
				'icon' => 'speedometer2',
				'title' => T_('Control Center'),
			],
			'messages' =>
			[
				'href' => \dash\url::kingdom(). '/account/notification',
				'icon' => 'envelope',
				'title' => T_('Messages'),
				'iconPulse' => true,
			],
			'business' =>
			[
				'href' => \dash\url::kingdom(). '/my/business',
				'icon' => 'shop-window',
				'title' => T_('Business'),
			],
			// 'support' =>
			// [
			// 	'href' => \dash\url::support(),
			// 	'icon' => 'info-circle',
			// 	'title' => T_('Help Center'),
			// ],
			'account' =>
			[
				'href' => \dash\url::kingdom(). '/account',
				'icon' => 'person-square',
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
			'dashboard' =>
			[
				'href' => \dash\url::kingdom(). '/a',
				'icon' => 'home',
				'iconGroup' => 'major',
				'title' => T_('Dashboard'),
			],
			'products' =>
			[
				'href' => \dash\url::kingdom(). '/a/products',
				'icon' => 'Products',
				'iconGroup' => 'major',
				'title' => T_('products'),
			],
			'orders' =>
			[
				'href' => \dash\url::kingdom(). '/a/order',
				'icon' => 'orders',
				'iconGroup' => 'major',
				'title' => T_('Orders'),
				'iconPulse' => true,
			],
			// 'report' =>
			// [
			// 	'href' => \dash\url::kingdom(). '/a/report',
			// 	'icon' => 'analytics',
			// 'iconGroup' => 'major',
			// 	'title' => T_('Report'),
			// ],
			'setting' =>
			[
				'href' => \dash\url::kingdom(). '/a/setting',
				'icon' => 'settings',
				'iconGroup' => 'major',
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
				$myFooter['dashboard']['selected'] = true;
				break;
		}

		return $myFooter;
	}


	/**
	 * Use in content_site/options/responsive_footer
	 * To show default pwa menu links
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function public_pwa_menu()
	{
		return
		[
			'home' =>
			[
				'href'  => \dash\url::kingdom(),
				'icon'  => 'home',
				'iconGroup'  => 'major',
				'title' => T_('Home'),
			],
			'category' =>
			[
				'href' => \dash\url::kingdom(). '/category',
				'icon' => 'Categories',
				'iconGroup'  => 'major',
				'title' => T_('Category'),
			],
			'cart' =>
			[
				'href' => \dash\url::kingdom(). '/cart',
				'icon' => 'cart',
				'iconGroup'  => 'major',
				'title' => T_('Cart'),
				'cartItem' => \dash\fit::number(\dash\data::myCart_count()),

			],
			'profile' =>
			[
				'href' => \dash\url::kingdom(). '/profile',
				'icon' => 'profile',
				'iconGroup'  => 'major',
				'img'   => 'profile',
				'title' => T_('Profile'),
			],
		];

	}


	public static function businessWebsite()
	{
		$footer = \dash\data::currentFooterPwaBtn();

		if($footer && is_array($footer))
		{
			$myFooter =  [];

			for ($i = 0; $i <= 5 ; $i++)
			{
				if(a($footer, $i))
				{
					$myFooter[] =
					[
						'href'      => a($footer, $i, 'url') ?  a($footer, $i, 'url') : '#',
						'icon'      => a($footer, $i, 'icon'),
						'iconGroup' => a($footer, $i, 'major'),
						'title'     => a($footer, $i, 'title'),
					];
				}
			}
		}
		elseif($footer === false || $footer === null)
		{
			// remove footer
			$myFooter = [];
		}
		else
		{
			$myFooter = self::public_pwa_menu();
		}

		// select module if user select them
		switch (\dash\url::module())
		{
			case 'category':
				if(isset($myFooter['category']))
				{
					$myFooter['category']['selected'] = true;
				}
				break;

			case 'cart':
				if(isset($myFooter['cart']))
				{
					$myFooter['cart']['selected'] = true;
				}
				break;

			case 'profile':
				if(isset($myFooter['profile']))
				{
					$myFooter['profile']['selected'] = true;
				}
				break;

			default:
				if(isset($myFooter['home']))
				{
					$myFooter['home']['selected'] = true;
				}
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

		if(\dash\data::pawContactUsShopBtn())
		{
			$myFooter =
			[
				'cart' =>
				[
					'href' => \dash\data::pawContactUsShopBtn_link(),
					'title' => \dash\data::pawContactUsShopBtn_title(),
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



	public static function businessCartPage()
	{
		if(!\dash\data::myCart_count())
		{
			return	self::businessWebsite();
		}

		$myFooter =
		[
			'cart' =>
			[
				'href' => \dash\url::kingdom(). '/shipping',
				'title' => T_('Buy'). ' ( '. \dash\fit::number(\dash\data::myCart_count()). ' )',
				'class' => 'pwafooterGoShipping',
			],

			'total' =>
			[
				'href' => \dash\url::kingdom(). '/shipping',
				'title' => \dash\fit::number(\dash\data::myCart_payableString()),
				'class' => 'pwafooterGoShipping',
			],
		];


		return $myFooter;
	}



	public static function businessShippingPage()
	{
		if(!\dash\data::myCart_count())
		{
			return	self::businessWebsite();
		}

		$myFooter =
		[
			'cart' =>
			[
				'form' => 'shippingForm',
				'title' => T_('Pay'). ' '. \dash\fit::number(\dash\data::myCart_total_full()),
				'class' => 'pwafooterPay',
			],
		];


		return $myFooter;
	}
}
?>
