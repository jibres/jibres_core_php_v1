<?php
namespace content\home;


class view
{
	public static function config()
	{
		\dash\data::bodyclass('unselectable vflex');

		$homepageShortDesc = '';
		$homepageShortDesc .= T_('All-in-One Ecommerce Software'). '. ';
		$homepageShortDesc .= T_('Online Store Website'). ' + ';
		$homepageShortDesc .= T_('Mobile Online Store'). ' + ';
		$homepageShortDesc .= T_('Social Marketing'). ' + ';
		$homepageShortDesc .= T_('POS Software'). '. ';

		$homepageShortDesc .= T_('Jibres is a next generation technology for integrated eCommerce platform software.'). ' ';
		$homepageShortDesc .= T_('Easiest way to make money in digital age.'). ' ';
		$homepageShortDesc .= T_('Sell more and more.'). ' ';


		\dash\data::page_seotitle(\dash\data::site_title(). ' - '. T_('Sale and Enjoy'). ' :)');
		// dash\data::page_seotitle()
		\dash\data::page_desc2($homepageShortDesc);
		\dash\data::page_special(true);

		\dash\data::homepagenumber(\lib\app\statistics\homepage::get());


	}
}
?>