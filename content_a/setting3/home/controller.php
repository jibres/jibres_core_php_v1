<?php
namespace content_a\setting3\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

		// load setting category
		$list = self::setting_category();
		\dash\data::settingCategory($list);



		$child          = \dash\url::child();
		$subchild       = \dash\url::subchild();
		$accepted_child = array_keys($list);

		$child_detail = [];

		$allow = false;

		if($child)
		{
			if(in_array($child, $accepted_child))
			{
				$allow = true;
				\dash\data::myChild($child);

				if(\dash\data::myChild() && is_callable(['\\content_a\\setting3\\home\\view', \dash\data::myChild()]))
				{
					$child_detail = call_user_func(['\\content_a\\setting3\\home\\view', \dash\data::myChild()]);

					\dash\data::settingOptions($child_detail);
				}

				if(a($list, $child, 'special_html'))
				{
					\dash\data::specialHtml(a($list, $child, 'special_html'));
				}
			}

			if($subchild)
			{
				if(in_array($subchild, array_keys($child_detail)))
				{
					$allow = true;

					if(a($child_detail, $subchild, 'special_html'))
					{
						\dash\data::specialHtml(a($child_detail, $subchild, 'special_html'));
					}
				}
			}
		}

		if(\dash\url::dir(3))
		{
			$allow = false;
		}


		if($allow)
		{
			\dash\open::get();
			\dash\open::post();
		}
	}


	/**
	 * Make setting category array
	 */
	public static function setting_category()
	{
		$list = [];


		$list['general'] =
		[
			'icon'  => \dash\utility\icon::svg('gear', 'bootstrap'),
			'title' => T_("General"),
			'link'  => \dash\url::this(). '/general',
		];


		$list['a123'] =
		[
			'icon'         => \dash\utility\icon::svg('123', 'bootstrap'),
			'title'        => T_("Security"),
			'link'         => \dash\url::this(). '/a123',
			'special_html' => 'test',
		];


		$list['app'] =
		[
			'icon'  => \dash\utility\icon::svg('app', 'bootstrap'),
			'title' => T_("Application"),
			'link'  => \dash\url::this(). '/app',
		];

		return $list;
	}
}
?>