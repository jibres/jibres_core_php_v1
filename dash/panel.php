<?php
namespace dash;


class panel
{
	public static function sidebar()
	{
		if(\dash\engine\store::inStore())
		{
			switch (\dash\url::content())
			{
				case 'a':
				case 'crm':
				case 'cms':
					return self::sidebar_businsess();
					break;

				default:
					break;
			}
		}

		// show jibres menu
		return self::sidebar_jibres_primary();
	}

	private static function jibresControlCenterLink()
	{
		$menu =
		[
			[
					'title'  => T_("Control Center"),
					'link'   => \dash\url::sitelang(). '/my',
					// 'icon'   => 'diamond',
					// 'img'    => \dash\url::icon(),
					'img'    => \dash\url::cdn().'/logo/icon-white/svg/Jibres-Logo-icon-white.svg',
					'active' => (\dash\url::content()==='my'? 1 :false)
			]
		];

		return $menu;
	}


	private static function businessDashboardLink()
	{
		$menu =
		[
				'title'  => T_("Business Dashboard"),
				'link'   => \dash\url::kingdom().'/a',
				'icon'   => 'gauge',
				'active' => (\dash\url::content()==='a' && \dash\url::module() === null? 1 :false)
		];
		return $menu;
	}


	private static function sidebar_jibres_primary()
	{
		$menu = self::jibresControlCenterLink();

		if(\dash\permission::check('_group_crm'))
		{
			$menu[] =
			[
				'title'  => T_("Customers - CRM"),
				'link'   => \dash\url::kingdom().'/crm',
				'icon'   => 'atom',
				'active' => (\dash\url::content()==='crm'? true :false)
			];
		}

		$menu[] = ['seperator' => true];
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

		return $menu;
	}


	private static function sidebar_jibres_cms()
	{
		if(\dash\engine\store::inStore())
		{
			$menu = self::jibresControlCenterLink();
			$menu[] = self::businessDashboardLink();
			$menu[] = ['seperator' => true];
		}
		else
		{
			$menu = self::jibresControlCenterLink();
			$menu[] = ['seperator' => true];
		}

		if(\dash\permission::check('_group_cms'))
		{
			$menu[] =
			[
				'title'  => T_("Content Management System"),
				'link'   => \dash\url::here(),
				'icon'   => 'file-text',
				'active' => 1,
			];

			$menu[] =
			[
				'title'  => T_("News"),
				'link'   => \dash\url::here(). '/posts',
				'icon'   => 'pinboard',
				'active' => (\dash\url::module()==='posts'&& !\dash\request::get('type')? true :false)
			];


			$menu[] =
			[
				'title'  => T_("Categories"),
				'link'   => \dash\url::here(). '/terms?type=cat',
				'icon'   => 'grid',
				'active' => (\dash\url::module()==='terms'&& \dash\request::get('type')==='cat'? true :false)
			];


			$menu[] =
			[
				'title'  => T_("Keywords"),
				'link'   => \dash\url::here(). '/terms?type=tag',
				'icon'   => 'tags',
				'active' => (\dash\url::module()==='terms'&& \dash\request::get('type')==='tag'? true :false)
			];

			$menu[] =
			[
				'title'  => T_("Static Pages"),
				'link'   => \dash\url::here(). '/posts?type=page',
				'icon'   => 'pinboard',
				'active' => (\dash\url::module()==='posts'&& \dash\request::get('type')==='page'? true :false)
			];
		}

		if(\dash\permission::check('cmsManageHelpCenter'))
		{
			$menu[] =
			[
				'title'  => T_("Help Center Articles"),
				'link'   => \dash\url::here(). '/posts?type=help',
				'icon'   => 'clone',
				'active' => (\dash\url::module()==='posts'&& \dash\request::get('type')==='help'? true :false)
			];
		}



		if(\dash\permission::check('cmsCommentView'))
		{
			$menu[] =
			[
				'title'  => T_("All Comments"),
				'link'   => \dash\url::here(). '/comments',
				'icon'   => 'comments',
				'active' => (\dash\url::module()==='comments'? true :false)
			];
		}

		if(\dash\permission::check('cmsAttachmentView'))
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


	private static function sidebar_businsess()
	{
		$menu = [];

		$menu[] = self::businessDashboardLink();

		if(\dash\permission::check('_group_orders'))
		{
			$menu[] =
			[
				'title'  => T_("Orders"),
				'link'   => \dash\url::kingdom().'/a/order',
				'icon'   => 'caddie-shopping-streamline',
				'active' => (\dash\url::module()==='order'? true :false)
			];
		}


		$menu[] =
		[
			'title'  => T_("Products"),
			'link'   => \dash\url::kingdom().'/a/products',
			'icon'   => 'tags',
			'active' => (\dash\url::module()==='products'? true :false)
		];


		if(\dash\permission::check('_group_crm'))
		{
			$menu[] =
			[
				'title'  => T_("Customers - CRM"),
				'link'   => \dash\url::kingdom().'/crm',
				'icon'   => 'atom',
				'active' => (\dash\url::content()==='crm'? true :false)
			];
		}

		if(\dash\permission::check('_group_cms'))
		{
			$menu[] =
			[
				'title'  => T_("Content Management"),
				'link'   => \dash\url::kingdom().'/cms',
				'icon'   => 'file-text',
				'active' => (\dash\url::content()==='cms'? true :false)
			];
		}

		{
			$menu[] =
			[
				'title'  => T_("Reports"),
				'link'   => \dash\url::kingdom().'/a/report',
				'icon'   => 'bar-chart',
				'active' => (\dash\url::module()==='report'? true :false)
			];
		}


		if(\dash\permission::check('_group_setting'))
		{
			$menu[] =
			[
				'title'  => T_("Settings"),
				'link'   => \dash\url::kingdom().'/a/setting',
				'icon'   => 'cogs',
				'active' => (\dash\url::module()==='setting'? true :false)
			];
		}
		$menu[] = ['seperator' => true];
		$menuFinal = array_merge($menu, self::jibresControlCenterLink());

		return $menuFinal;
	}

}
?>