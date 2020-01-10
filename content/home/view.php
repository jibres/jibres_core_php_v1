<?php
namespace content\home;


class view
{
	public static function config()
	{
		\dash\data::bodyclass('unselectable vflex');

		\dash\data::page_title(\dash\data::site_title(). ' - '. T_('Sale and Enjoy'). ' :)');
		\dash\data::page_special(true);

		\dash\data::homepagenumber(\lib\app\statistics\homepage::get());

	}
}
?>