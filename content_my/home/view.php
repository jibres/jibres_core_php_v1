<?php
namespace content_my\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres my'));
		\dash\data::page_desc(T_('Sell and Enjoy'));

		if(!\dash\detect\device::detectPWA())
		{
			// \dash\redirect::to(\dash\url::kingdom(). '/store');
		}
		\dash\data::include_adminPanel(true);

		$myFooter =
		[
			[
				'href' => \dash\url::kingdom(). '/my',
				'selected' => true,
				'icon' => 'gauge',
				'title' => T_('Dashboard'),
			],
			[
				'href' => \dash\url::kingdom(). '/account/notification',
				'icon' => 'comments',
				'title' => T_('Messages'),
			],
			[
				'href' => \dash\url::kingdom(). '/my/store',
				'icon' => 'money',
				'title' => T_('Stores'),
			],
			[
				'href' => \dash\url::kingdom(). '/support',
				'icon' => 'info-circle',
				'title' => T_('Help Center'),
			],
			[
				'href' => \dash\url::kingdom(). '/account',
				'icon' => 'user',
				'title' => T_('Profile'),
			],
		];
		\dash\data::pwa_footer($myFooter);

	}
}
?>