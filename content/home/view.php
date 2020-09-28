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


		\dash\face::seo(\dash\face::site(). ' - '. T_('No.1 Free eCommerce Solution'));

		// Starting An Online Store? - Try Shopify® For Free
		#All-In-One Commerce Solution - Ecommerce Software And Point Of Sale
		#Start, grow, and scale your business - Shopify
		#
		#
		#
		#1 Free E-commerce Shopping Cart &amp; Online Store Solution - Try Ecwid!
		#Ecwid: #1 Free and Easy E-commerce Shopping Cart Solution - Try Ecwid Today!
		#
		#
		#BigCommerce.com - eCommerce CMS - Create your online store
		#BigCommerce: Ecommerce for a New Era
		#
		#
		#Jibres #1
		#Jibres Sell and Enjoy





		// Open your online store with the Ecwid designer. Create a store yourself, without programmers and designers. Sell anywhere. Manage your store. Market your bussines. Try it free. Features: Single Dashboard, Easy-To-Use Marketing Tools.

		// Try Shopify for free and get more than just an ecommerce solution. Sell anywhere, to anyone, with Shopify's ecommerce platform and point of sale features.
		//
		// Try the best ecommerce platform for growing brands with a free 15-day trial. Standard Plan: $29.95 per month. Integrate Anything. Design with Freedom. Operate without Worry. Powerful Analytics. Shows: Design with Freedom, Operate without Worry, Powerful Analytics.
		// Learn how BigCommerce can fuel your business with all the capabilities of enterprise ecommerce—without the cost or complexity.




		\dash\face::title(\dash\face::site(). ' - '. T_('Start Selling'));
		// for bots check seo title
		if(\dash\agent::isBot())
		{
			\dash\face::title(\dash\face::seo());
		}

		// set pwa title
		\dash\face::titlePWA(\dash\face::site());
		\dash\face::logoPWA(\dash\url::icon());

		\dash\data::homepagenumber(\lib\app\statistics\homepage::get());

		\dash\data::moneyUnit('$');
		if(\dash\language::current() === 'fa')
		{
			\dash\data::moneyUnit(T_('Hezar Toman'));
		}

		if(\dash\user::id())
		{
			// back
			\dash\data::action_text(T_('Dashboard'));
			\dash\data::action_link(\dash\url::kingdom(). '/my');
		}
		else
		{
			// btn
			\dash\data::action_text(T_('Enter'));
			\dash\data::action_link(\dash\url::this(). '/enter');
		}


		// add page cover to all pages
		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-3.jpg');
		if(\dash\url::tld() === 'ir')
		{
			\dash\face::cover(\dash\url::cdn(). '/img/cover/ir/Jibres-cover-fa-3.jpg');
		}


		$quote =
		[
			[
				"name"     => T_("Majid Sadeghi"),
				"position" => T_("Sales Supervisor at SuperSaeed"),
				"avatar"   => "majid-sadeghi.jpg",
				"quote"    => T_("With Jibres we take less time of our customers and this means modern customer orientation"). '.',
			],
			[
				"name"     => T_("Ahmad Karimi"),
				"position" => T_("UX Designer"),
				"avatar"   => "ahmad-karimi.jpg",
				"quote"    => T_("Who would have thought that one day an Iranian company could launch such a simple and attractive domain registration system? That one, despite something called IRNIC! Keep up the good work, Jibres!"),
			],
			[
				"name"     => T_("Hasan Salehi"),
				"position" => T_("Software Developer"),
				"avatar"   => "hasan-salehi.jpg",
				"quote"    => T_("It was one of the best and most convenient domain registration panels I've ever seen, especially the three-letter domain dictionary :))"),
			],
		];

		shuffle($quote);
		\dash\data::quote($quote);


		$domainPrice =
		[
			'ir1year' => \lib\app\nic_domain\price::register('1year'),
		];

		\dash\data::domainPrice($domainPrice);
	}
}
?>