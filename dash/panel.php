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
			if(\dash\url::content() === 'cms')
			{
				return self::sidebar_jibres_cms();
			}
			if(\dash\url::content() === 'crm')
			{
				return self::sidebar_jibres_crm();
			}
			if(\dash\url::content() === 'support')
			{
				return self::sidebar_jibres_support();
			}

			// show jibres menu
			return self::sidebar_jibres_primary();
		}

		return [];
	}

	private static function jibresPanelLink($_onlyMenu = null)
	{
		$menu =
		[
			[
					'title'  => T_("Jibres Panel"),
					'link'   => \dash\url::sitelang(). '/my',
					// 'icon'   => 'diamond',
					// 'img'    => \dash\url::icon(),
					'img'    => \dash\url::cdn().'/logo/icon-white/svg/Jibres-Logo-icon-white.svg',
					'active' => (\dash\url::content()==='my'? 1 :false)
			]
		];

		if($_onlyMenu)
		{
			return $menu;
		}
		// add seperator
		$menu[] = [ 'seperator' => true];
		return $menu;
	}


	private static function sidebar_jibres_primary()
	{
		$menu = self::jibresPanelLink();
		$menu[] =
		[
			'title'  => T_("Domain Center"),
			'link'   => \dash\url::sitelang(). '/my/domain',
			'icon'   => 'terminal',
			'active' => (\dash\url::content()==='my'&& \dash\url::module()==='domain'? true :false)
		];
		$menu[] =
		[
			'title'  => T_("My Business"),
			'link'   => \dash\url::sitelang(). '/my/business',
			'icon'   => 'heart',
			'active' => (\dash\url::content()==='my'&& \dash\url::module()==='business'? true :false)
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


	private static function sidebar_jibres_cms()
	{
		$menu = self::jibresPanelLink();

		$menu[] =
		[
			'title'  => T_("Content Management System"),
			'link'   => \dash\url::here(),
			'icon'   => 'file-text',
			'active' => 1,
		];

		if(\dash\permission::check('cpPostsView'))
		{
			$menu[] =
			[
				'title'  => T_("News"),
				'link'   => \dash\url::here(). '/posts',
				'icon'   => 'pinboard',
				'active' => (\dash\url::module()==='posts'&& !\dash\request::get('type')? true :false)
			];
		}
		if(\dash\permission::check('cpCategoryView'))
		{
			$menu[] =
			[
				'title'  => T_("Categories"),
				'link'   => \dash\url::here(). '/terms?type=cat',
				'icon'   => 'grid',
				'active' => (\dash\url::module()==='terms'&& \dash\request::get('type')==='cat'? true :false)
			];
		}
		if(\dash\permission::check('cpTagView'))
		{
			$menu[] =
			[
				'title'  => T_("Keywords"),
				'link'   => \dash\url::here(). '/terms?type=tag',
				'icon'   => 'tags',
				'active' => (\dash\url::module()==='terms'&& \dash\request::get('type')==='tag'? true :false)
			];
		}
		if(\dash\permission::check('cpPageView'))
		{
			$menu[] =
			[
				'title'  => T_("Static Pages"),
				'link'   => \dash\url::here(). '/posts?type=page',
				'icon'   => 'pinboard',
				'active' => (\dash\url::module()==='posts'&& \dash\request::get('type')==='page'? true :false)
			];
		}

		if(\dash\permission::check('cpHelpCenterView'))
		{
			$menu[] =
			[
				'title'  => T_("Help Center Articles"),
				'link'   => \dash\url::here(). '/posts?type=help',
				'icon'   => 'clone',
				'active' => (\dash\url::module()==='posts'&& \dash\request::get('type')==='help'? true :false)
			];
		}

		if(\dash\permission::check('cpTagHelpAdd') || \dash\permission::check('cpTagHelpEdit'))
		{
			$menu[] =
			[
				'title'  => T_("Help Center Keywords"),
				'link'   => \dash\url::here(). '/terms?type=help_tag',
				'icon'   => 'tags',
				'active' => (\dash\url::module()==='terms'&& \dash\request::get('type')==='help_tag'? true :false)
			];
		}

		if(\dash\permission::check('cpCommentsView'))
		{
			$menu[] =
			[
				'title'  => T_("All Comments"),
				'link'   => \dash\url::here(). '/comments',
				'icon'   => 'comments',
				'active' => (\dash\url::module()==='comments'? true :false)
			];
		}

		if(\dash\permission::check('cpPostsView'))
		{
			$menu[] =
			[
				'title'  => T_("Files Library"),
				'link'   => \dash\url::here(). '/attachment',
				'icon'   => 'file-o',
				'active' => (\dash\url::module()==='attachment'? true :false)
			];
			$menu[] =
			[
				'title'  => T_("Add new file"),
				'link'   => \dash\url::here(). '/attachment/add',
				'icon'   => 'plus',
				'active' => (\dash\url::module()==='attachment'? true :false)
			];
		}

		return $menu;
	}


	private static function sidebar_jibres_crm()
	{
		$menu = self::jibresPanelLink();

		$menu[] =
		[
			'title'  => T_("Customer Relationship Management"),
			'link'   => \dash\url::here(),
			'icon'   => 'atom',
			'class'  => 'font-11',
			'active' => 1,
		];

		if(\dash\permission::check('cpUsersView'))
		{
			$menu[] =
			[
				'title'  => T_("Users"),
				'link'   => \dash\url::here(). '/member',
				'icon'   => 'users',
				'active' => (\dash\url::module()==='attachment'? true :false)
			];
		}

		if(\dash\permission::check('cpUsersAdd'))
		{
			$menu[] =
			[
				'title'  => T_("Add new user"),
				'link'   => \dash\url::here(). '/member/add',
				'icon'   => 'user-plus',
				'active' => (\dash\url::module()==='member'&& \dash\url::child()==='add'? true :false)
			];
		}

		if(\dash\permission::check('cpPermissionView'))
		{
			$menu[] =
			[
				'title'  => T_("Permissions"),
				'link'   => \dash\url::here(). '/permission',
				'icon'   => 'lock',
				'active' => (\dash\url::module()==='permission'? true :false)
			];
		}


		if(\dash\permission::check('cpTransaction'))
		{
			$menu[] =
			[
				'title'  => T_("Transactions"),
				'link'   => \dash\url::here(). '/transactions',
				'icon'   => 'card',
				'active' => (\dash\url::module()==='transactions'? true :false)
			];
		}
		if(\dash\permission::check('cpTransactionAdd'))
		{
			$menu[] =
			[
				'title'  => T_("Plus charge account"),
				'link'   => \dash\url::here(). '/transactions/add',
				'icon'   => 'plus-circle',
				'active' => (\dash\url::module()==='transactions'&& \dash\url::child()==='add'? true :false)
			];

			$menu[] =
			[
				'title'  => T_("Minus charge account"),
				'link'   => \dash\url::here(). '/transactions/minus',
				'icon'   => 'minus-circle',
				'active' => (\dash\url::module()==='transactions'&& \dash\url::child()==='minus'? true :false)
			];
		}

		return $menu;
	}


	private static function sidebar_jibres_support()
	{
		$menu = self::jibresPanelLink();

		$menu[] =
		[
			'title'  => T_("Help Center"),
			'link'   => \dash\url::here(),
			'icon'   => 'life-ring',
			'active' => 1,
		];

		$menu[] =
		[
			'title'  => T_("Tickets"),
			'link'   => \dash\url::here().'/ticket',
			'icon'   => 'question-circle',
			'active' => (\dash\url::module()==='ticket'? true :false)
		];

		$menu[] =
		[
			'title'  => T_("New ticket"),
			'link'   => \dash\url::here().'/ticket/add',
			'icon'   => 'plus',
			'active' => (\dash\url::module()==='ticket'&& \dash\url::child()==='add'? true :false)
		];

		return $menu;
	}

	private static function sidebar_businsess()
	{

	}
}
?>