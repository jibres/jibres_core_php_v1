<?php
namespace content\home;


class view
{
	public static function config()
	{
		\lib\data::bodyclass('unselectable vflex');
		// $this->include->js     = false;
		\lib\data::homepagenumber(\lib\utility\homepagenumber::get());

		self::set_static_titles();
	}


	/**
	 * set title of static pages in project
	 */
	private static function set_static_titles()
	{
		switch (\lib\url::module())
		{
			case '':
			case null:
				\lib\data::page(\lib\data::get('site', 'title'). ' - '. T_('Integrated Sales and Online Accounting'), 'title');
				\lib\data::page(true, 'special');
				break;

			case 'benefits':
				\lib\data::page(T_('Jibres benefits'), 'title');
				\lib\data::page(T_('What can you do with Jibres?'), 'desc');
				break;

			default:
				\lib\data::page(\lib\data::get('site', 'title'). ' - '. T_('Integrated Sales and Online Accounting'), 'title');
				break;
		}
	}
}
?>