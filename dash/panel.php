<?php
namespace dash;


class panel
{
	public static function sidebar_jibres_primary()
	{
		$menu =
		[
			[
				'title'  => T_("Jibres Panel"),
				'link'   => \dash\url::sitelang(). '/my',
				'icon'   => 'atom',
				'active' => (\dash\url::content() === 'my'? true :false)
			],
			[
				'title'  => T_("Domain Center"),
				'link'   => \dash\url::sitelang(). '/my/domain',
				'icon'   => 'flag',
				'active' => (\dash\url::content()==='my'&& \dash\url::module()==='domain'? true :false)
			],
			[
				'title'  => T_("My Business"),
				'link'   => \dash\url::sitelang(). '/my/business',
				'icon'   => 'heart',
				'active' => (\dash\url::content()==='my'&& \dash\url::module()==='business'? true :false)
			],
		];

		return $menu;
	}

	public static function sidebar_businsess()
	{

	}
}
?>