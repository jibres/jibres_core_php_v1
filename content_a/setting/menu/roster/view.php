<?php
namespace content_a\setting\menu\roster;


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


		\dash\data::menuChilCount(\dash\temp::get('calcMenuChildCount'));
		\dash\data::menuChild($load_menu_child);

	}
}
?>
