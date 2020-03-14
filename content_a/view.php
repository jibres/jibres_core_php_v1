<?php
namespace content_a;


class view
{
	public static function config()
	{
		\dash\data::site_title(T_("Jibres"));
		\dash\data::site_desc(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));


		// enable title box
		if(\dash\url::module() == 'setup')
		{
			\dash\data::userToggleSidebar(false);
			\dash\data::page_titleBox(false);
		}

		\dash\data::include_adminPanel(true);
		\dash\data::include_editor(true);
		// use old version of chart until new version is being stable
		\dash\data::include_highcharts(true);

		\dash\data::site_title(\lib\store::title());
		\dash\data::store(\lib\store::detail());
		// \dash\data::currentStore(\lib\app\store::ready(\lib\store::detail()));
		\dash\data::site_logo(\lib\store::logo());

		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);


		// $cache_key = 'staff_list_'.\dash\url::subdomain();
		// $cache = \dash\session::get($cache_key, 'jibres_store');
		// if(!$cache)
		// {
		// 	$cache = \lib\app\thirdparty::list(null, ['staff' => 1]);
		// 	$new = [];
		// 	foreach ($cache as $key => $value)
		// 	{
		// 		$new[] =
		// 		[
		// 			'id'        => isset($value['id']) ? $value['id'] : null,
		// 			'firstname' => isset($value['firstname']) ? $value['firstname'] : null,
		// 			'lastname'  => isset($value['lastname']) ? $value['lastname'] : null,
		// 			'mobile'    => isset($value['mobile']) ? $value['mobile'] : null,
		// 		];
		// 	}
		// 	\dash\session::set($cache_key, $new, 'jibres_store', (60*10));
		// }
		// \dash\data::staffList($cache);

	}
}
?>