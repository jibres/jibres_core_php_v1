<?php
namespace content\home;


class view
{
	public static function config()
	{
		// \mvc\view::project();

		\dash\data::bodyclass('unselectable vflex');
		// $this->include->js     = false;
		\dash\data::homepagenumber(\lib\utility\homepagenumber::get());

		\dash\data::page(\dash\data::get('site', 'title'). ' - '. T_('Integrated Sales and Online Accounting'), 'title');
		\dash\data::page(true, 'special');
	}
}
?>