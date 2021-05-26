<?php
namespace content_business;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		$store_title = \lib\store::detail('title');
		if($store_title)
		{
			\dash\face::site($store_title);
			\dash\face::title($store_title);
		}

		$store_desc = \lib\store::detail('desc');
		if($store_desc)
		{
			\dash\face::desc($store_desc);
			\dash\face::intro($store_desc);
		}
		else
		{
			\dash\face::desc($store_title);
		}

		$store_logo = \lib\store::logo();
		if($store_logo && !\dash\face::cover())
		{
			\dash\face::cover($store_logo);
			\dash\face::twitterCard('summary');
			\dash\face::logo($store_logo);
		}

		switch (\dash\data::website_template())
		{
			case 'comingsoon':
				\dash\face::disablePWA_Header(true);
				\dash\face::css(["business/comingsoon-1/comingsoon-1.css"]);
				break;

			case 'visitcard':
				\dash\face::disablePWA_Header(true);
				\dash\face::css(
					[
						"business/visitcard-1/visitcard-1.css",
						"https://fonts.googleapis.com/css?family=Quicksand:300,400"
					]
				);
				\dash\face::twitterCard('summary_large_image');
				break;

			default:
				break;
		}

		\dash\upload\size::set_default_file_size('business');

		self::customStyle();
	}


	private static function customStyle()
	{
		if(!\lib\store::enterprise())
		{
			return null;
		}
		$style = null;

		switch (\lib\store::enterprise())
		{
			case 'rafiei':
				$style = [
					'enterprise/'. \lib\store::enterprise(). '/style.css'
				];
				break;

			default:
				break;
		}
		// set style
		if($style)
		{
			\dash\face::css($style);
		}
	}
}
?>