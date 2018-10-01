<?php
namespace content_a;


class view
{
	public static function config()
	{
		\dash\data::site_title(T_("Jibres"));
		\dash\data::site_desc(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));

		\dash\data::service_title(T_("Jibres"));
		\dash\data::service_desc(T_("Jibres is not just an online accounting software;"). ' <br> '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::service_slogan(T_("Integrated Sales and Online Accounting"));
		\dash\data::service_logo(\dash\url::site(). '/static/siftal/images/logo/jibres.png');
		\dash\data::service_url('https://jibres.com');

		// transfer to new location on root of content
		\dash\data::display_admin('content_a/layout.html');

		\dash\data::include_adminPanel(true);
		\dash\data::include_css(true);
		// \dash\data::include_chart(true);
		// use old version of chart until new version is being stable
		\dash\data::include_highcharts(true);

		\dash\data::site_title(\lib\store::name());
		\dash\data::store(\lib\store::detail());
		\dash\data::site_logo(\dash\data::store_logo());

		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);

		// set usable variable
		\dash\data::moduleType(\dash\request::get('type'));
		\dash\data::moduleTypeP('?type='. \dash\data::moduleType());

		$cache_key = \lib\store::id(). '_staff_list';
		$cache = \dash\session::get($cache_key);
		if(!$cache)
		{
			$cache = \lib\app\thirdparty::list(null, ['staff' => 1]);
			\dash\session::set($cache_key, $cache, null, (60*10));
		}
		\dash\data::staffList($cache);

	}
}
?>