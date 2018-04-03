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


			case 'help':
				switch (\lib\url::child())
				{
					case 'faq':
						\lib\data::page(T_('Frequently Asked Questions'), 'title');
						\lib\data::page(T_('This FAQ provides answers to basic questions about Jibres.'), 'desc');
						break;

					default:
						\lib\data::page(T_('Help Center'), 'title');
						\lib\data::page(T_('Need HELP? Be patient...'), 'desc');
						break;
				}
				break;


			case 'benefits':
				\lib\data::page(T_('Jibres benefits'), 'title');
				\lib\data::page(T_('What can you do with Jibres?'), 'desc');
				break;


			case 'about':
				\lib\data::page(T_('About our platform'), 'title');
				\lib\data::page(\lib\data::get('site', 'desc'), 'desc');
				break;


			case 'pricing':
				\lib\data::page(T_('Plans and Pricing of Jibres'), 'title');
				\lib\data::page(T_("Always know what you'll pay per month.") . ' ' . T_('Simple pricing'), 'desc');
				break;



			default:
				\lib\data::page(\lib\data::get('site', 'title'). ' - '. T_('Integrated Sales and Online Accounting'), 'title');
				break;
		}
	}
}
?>