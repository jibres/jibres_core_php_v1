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


			// show jibres menu
			return self::sidebar_jibres_primary();
		}

		return [];
	}

	private static function jibresPanelLink()
	{
		return
		[
				'title'  => T_("Jibres Panel"),
				'link'   => \dash\url::sitelang(). '/my',
				// 'icon'   => 'diamond',
				// 'img'    => \dash\url::icon(),
				'img'    => \dash\url::cdn().'/logo/icon-white/svg/Jibres-Logo-icon-white.svg',
				'active' => (\dash\url::content()==='my'? 1 :false)
			];
	}


	private static function sidebar_jibres_primary()
	{
		$menu = [ self::jibresPanelLink() ];
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
		$menu = [ self::jibresPanelLink() ];

		if(\dash\permission::check('cpPostsView'))
		{
			$menu[] =
			[
				'title'  => T_("News"),
				'link'   => \dash\url::here(). '/posts',
				'icon'   => 'pinboard',
				'active' => (\dash\url::content()==='cms'&& \dash\url::module()==='posts'&& !\dash\request::get('type')? true :false)
			];
		}
		if(\dash\permission::check('cpCategoryView'))
		{
			$menu[] =
			[
				'title'  => T_("Categories"),
				'link'   => \dash\url::here(). '/terms?type=cat',
				'icon'   => 'grid',
				'active' => (\dash\url::content()==='cms'&& \dash\url::module()==='terms'&& \dash\request::get('type')==='cat'? true :false)
			];
		}
		if(\dash\permission::check('cpTagView'))
		{
			$menu[] =
			[
				'title'  => T_("Keywords"),
				'link'   => \dash\url::here(). '/terms?type=tag',
				'icon'   => 'tags',
				'active' => (\dash\url::content()==='cms'&& \dash\url::module()==='terms'&& \dash\request::get('type')==='tag'? true :false)
			];
		}
		if(\dash\permission::check('cpPageView'))
		{
			$menu[] =
			[
				'title'  => T_("Static Pages"),
				'link'   => \dash\url::here(). '/posts?type=page',
				'icon'   => 'pinboard',
				'active' => (\dash\url::content()==='cms'&& \dash\url::module()==='posts'&& \dash\request::get('type')==='page'? true :false)

			];
		}


		return $menu;
	}


	private static function sidebar_businsess()
	{

	}
}
?>