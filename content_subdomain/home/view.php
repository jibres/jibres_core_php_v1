<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::store(\lib\store::detail());

		\dash\data::site_title(\dash\data::store_name(). ' | '. \dash\data::site_title());
		\dash\data::site_desc(\dash\data::store_desc());



		\dash\data::bodyclass('unselectable flex align-center justify-center txtC');
		\dash\data::include_js(false);

		\dash\data::service_title(T_("Jibres"));
		\dash\data::service_desc(T_("Jibres is not just an online accounting software;"). ' <br> '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::service_slogan(T_("Integrated Sales and Online Accounting"));
		\dash\data::service_logo(\dash\url::static(). '/siftal/images/logo/jibres.png');
		\dash\data::service_url('https://jibres.com');

		\dash\data::display_storesubdomain('content_subdomain/main/visitcard.html');
		// if the plan have site
		if(\dash\permission::supervisor())
		{
			\dash\data::include_adminPanel(true);
			\dash\data::include_css(true);
			\dash\data::include_js(true);
			\dash\data::include_highcharts(true);

			$siteDetail                  = [];
			$siteDetail['cat']           = \lib\app\product\cat::list();
			$siteDetail['last']          = \lib\app\product\site::last();
			$siteDetail['love']          = \lib\app\product\site::love();
			$siteDetail['amazing']       = \lib\app\product\site::by_cat('آدامس');
			$siteDetail['discount_1000'] = \lib\app\product\site::by_discount(1000);
			$siteDetail['discount']      = \lib\app\product\site::by_discount();

			\dash\data::siteDetail($siteDetail);

			\dash\data::display_storesubdomain('content_subdomain/home/site.html');
		}

	}
}
?>