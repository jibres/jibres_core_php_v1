<?php
namespace content_business;


class view
{
	private static $load_cart_detail_once = false;

	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		if(\dash\request::get('preview'))
		{
			\dash\data::HtmlPointerEventsNone(true);
		}

		\dash\upload\size::set_default_file_size('business');



		// set SEO detail
		$store_title = \lib\store::detail('title');
		// set if not set.
		// maybe set on load page builder
		if($store_title  && !\dash\face::title())
		{
			\dash\face::site($store_title);
			\dash\face::title($store_title);
		}

		$store_desc = \lib\store::detail('desc');
		if(!\dash\face::desc())
		{
			if($store_desc)
			{
				\dash\face::desc($store_desc);
				\dash\face::intro($store_desc);
			}
			else
			{
				\dash\face::desc($store_title);
			}
		}

		$store_logo = \lib\store::logo();
		if($store_logo && !\dash\face::cover())
		{
			\dash\face::cover($store_logo);
			\dash\face::twitterCard('summary');
			\dash\face::logo($store_logo);
		}
	}


	/**
	 * Load cart detail.
	 */
	public static function load_cart_detail()
	{
		// check load one
		if(self::$load_cart_detail_once)
		{
			return;
		}

		self::$load_cart_detail_once = true;

		$cart_detail = \lib\app\cart\search::my_detail();

		if(!is_array($cart_detail))
		{
			$cart_detail = [];
		}

		\dash\data::dataTable($cart_detail);

		$cart_summary = \lib\app\cart\search::my_detail_summary($cart_detail);

		$total_full = null;

		if(isset($cart_summary['total']))
		{
			$total_full =  $cart_summary['total']. ' '. \lib\store::currency();
		}

		\dash\data::cartSummary($cart_summary);

		$cart_setting = \lib\app\setting\get::cart_setting();
		\dash\data::cartSettingSaved($cart_setting);



		if(is_array($cart_detail))
		{
			$allType = array_column($cart_detail, 'type');
			if(count($allType) === 1 && a($allType, 0) === 'file')
			{
				\dash\data::fileMode(true);
			}
		}

		$myCart               = [];
		$myCart['count']      = count($cart_detail);
		$myCart['setting']    = $cart_setting;
		$myCart['total_full'] = $total_full;

		// pwa header
		// \dash\data::menu_link(true);
		\dash\data::cart_link(\dash\fit::number($myCart['count']));

		\dash\data::myCart($myCart);
	}

}
?>