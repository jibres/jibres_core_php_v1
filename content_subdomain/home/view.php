<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		\dash\data::site_title(\dash\data::store_name(). ' | '. \dash\data::site_title());
		\dash\data::site_desc(\dash\data::store_desc());


		\dash\data::display_storesubdomain('content_subdomain/main/visitcard.html');
		// if the plan have site
		// if(\dash\permission::supervisor())
		// {
		// 	$siteDetail                  = [];
		// 	$siteDetail['cat']           = \lib\app\product\cat::all_list();
		// 	$siteDetail['last']          = \lib\app\product\site::last();
		// 	$siteDetail['love']          = \lib\app\product\site::love();
		// 	$siteDetail['amazing']       = \lib\app\product\site::by_cat('آدامس');
		// 	$siteDetail['discount_1000'] = \lib\app\product\site::by_discount(1000);
		// 	$siteDetail['discount']      = \lib\app\product\site::by_discount();

		// 	\dash\data::siteDetail($siteDetail);

		// 	\dash\data::display_storesubdomain('content_subdomain/home/site.html');
		// }
		// else
		// {
		// }
			\dash\data::bodyclass('flex align-center justify-center txtC');
	}
}
?>