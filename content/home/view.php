<?php
namespace content\home;


class view
{
	public static function config()
	{
		$homepageShortDesc = '';
		$homepageShortDesc .= T_('All-in-One Ecommerce Software'). '. ';
		$homepageShortDesc .= T_('Online Store Website'). ' + ';
		$homepageShortDesc .= T_('Mobile Online Store'). ' + ';
		$homepageShortDesc .= T_('Social Marketing'). ' + ';
		$homepageShortDesc .= T_('POS Software'). '. ';

		if(\dash\language::current() == 'en')
		{
			$homepageShortDesc .= T_('Jibres is a next generation technology for integrated eCommerce platform software.'). ' ';
			$homepageShortDesc .= T_('Easiest way to make money in digital age.'). ' ';
		}

		$homepageShortDesc .= T_('Sell more and more.'). ' ';


		\dash\face::seo(\dash\face::site(). ' - '. T_('Sell and Enjoy'). ' :)');
		\dash\face::title(\dash\face::site());
		if (!\dash\detect\device::detectPWA())
		{
			\dash\face::title(\dash\face::site(). ' - '. T_('Sell and Enjoy'). ' :)');
		}

		\dash\data::homepagenumber(\lib\app\statistics\homepage::get());

		\dash\data::moneyUnit('$');
		if(\dash\language::current() === 'fa')
		{
			\dash\data::moneyUnit(T_('Hezar Toman'));
		}

		if(!\dash\user::id())
		{
			// btn
			\dash\data::action_text(T_('Enter'));
			\dash\data::action_link(\dash\url::this(). '/enter');
		}

		if(\dash\detect\device::detectPWA() && \dash\user::id())
		{
			// back
			\dash\data::action_text(T_('Dashboard'));
			\dash\data::action_link(\dash\url::kingdom(). '/my');
		}


		// allow to open homepage via enamad
		// @header('X-Frame-Options: https://enamad.ir');
    	// header('Access-Control-Allow-Origin: https://ermile.com', true);
	}
}
?>