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

		$quote =
		[
			[
				"name"     => T_("Majid Sadeghi"),
				"position" => T_("Sales Supervisor at SuperSaeed"),
				"avatar"   => T_("majid-sadeghi.jpg"),
				"quote"    => T_("With Jibres we take less time of our customers and this means modern customer orientation"). '.',
			],
			[
				"name"     => T_("Ahmad Karimi"),
				"position" => T_("UX Designer"),
				"avatar"   => T_("ahmad-karimi.jpg"),
				"quote"    => T_("Who would have thought that one day an Iranian company could launch such a simple and attractive domain registration system? That one, despite something called IRNIC! Keep up the good work, Jibres!"),
			],
			[
				"name"     => T_("Hasan Salehi"),
				"position" => T_("Software Developer"),
				"avatar"   => T_("hasan-salehi.jpg"),
				"quote"    => T_("It was one of the best and most convenient domain registration panels I've ever seen, especially the three-letter domain dictionary :))"),
			],
		];

		shuffle($quote);
		\dash\data::quote($quote);
	}
}
?>