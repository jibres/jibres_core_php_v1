<?php
namespace content\home;


class view
{
	public static function config()
	{
		\mvc\view::project();

		\lib\data::bodyclass('unselectable vflex');
		// $this->include->js     = false;
		\lib\data::homepagenumber(\lib\utility\homepagenumber::get());

		\lib\data::page(\lib\data::get('site', 'title'). ' - '. T_('Integrated Sales and Online Accounting'), 'title');
		\lib\data::page(true, 'special');
	}
}
?>