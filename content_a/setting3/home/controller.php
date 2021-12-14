<?php
namespace content_a\setting3\home;

class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_setting');

		// load setting category
		$list = category::setting_category();

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

				$child_detail = call_user_func(['\\content_a\\setting3\\home\\section\\'. $child, 'list']);

				\dash\data::settingOptions($child_detail);

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
}
?>