<?php
namespace content_a\website\menu\roster;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Edit menu items'));

		\dash\face::btnSetting(\dash\url::that(). '/setting?'. \dash\request::fix_get());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/menu');

		$load_menu_child = \lib\app\menu\get::child(\dash\request::get('id'));

		if(!$load_menu_child)
		{
			\dash\redirect::to(\dash\url::that(). '/item'. \dash\request::full_get());
		}

		\dash\data::menuChild($load_menu_child);

	}
}
?>
