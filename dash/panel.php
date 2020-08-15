<?php
namespace dash;


class panel
{
	public static function sidebar()
	{
		if(\dash\url::store())
		{
			// show store menu
		}
		else
		{
			// show jibres menu
			return self::sidebar_jibres_primary();
		}

		return [];
	}


	private static function sidebar_jibres_primary()
	{
		$menu =
		[
			[
				'title'  => T_("Jibres Panel"),
				'link'   => \dash\url::sitelang(). '/my',
				'icon'   => 'diamond',
				'active' => (\dash\url::content()==='my'? 1 :false)
			],
			[
				'title'  => T_("Domain Center"),
				'link'   => \dash\url::sitelang(). '/my/domain',
				'icon'   => 'terminal',
				'active' => (\dash\url::content()==='my'&& \dash\url::module()==='domain'? true :false)
			],
			[
				'title'  => T_("My Business"),
				'link'   => \dash\url::sitelang(). '/my/business',
				'icon'   => 'heart',
				'active' => (\dash\url::content()==='my'&& \dash\url::module()==='business'? true :false)
			],
		];

		// user account
		if(\dash\user::id())
		{
			$menu[] =
			[
				'title'  => T_("My Account"),
				'link'   => \dash\url::sitelang(). '/account',
				'icon'   => 'user',
				'active' => (\dash\url::content() === 'account'? true :false)
			];
		}
		// help center
		$menu[] =
		[
			'title'  => T_("Help Center"),
			'link'   => \dash\url::sitelang(). '/support',
			'icon'   => 'life-ring',
			'active' => (\dash\url::content() === 'support'? true :false)
		];


		return $menu;
	}

	private static function sidebar_businsess()
	{

	}
}
?>