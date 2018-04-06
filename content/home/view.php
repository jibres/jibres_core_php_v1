<?php
namespace content\home;


class view
{
	public static function config()
	{
		\dash\data::bodyclass('unselectable vflex');
		\dash\data::homepagenumber(\lib\utility\homepagenumber::get());

		\dash\data::page_title(\dash\data::site_title(). ' - '. T_('Integrated Sales and Online Accounting'));
		\dash\data::page_special(true);
	}
}
?>