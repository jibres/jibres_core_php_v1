<?php
namespace content_site;


class view
{
	public static function config()
	{
		\dash\face::site(T_("Jibres"));
		\dash\face::intro(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\face::slogan(T_("Integrated Sales and Online Accounting"));


		\dash\data::include_adminPanelBuilder("siteBuilder");
		// use old version of chart until new version is being stable

		\dash\face::site(\lib\store::title());
		\dash\data::store(\lib\store::detail());
		\dash\face::logo(\lib\store::logo());

		// set shortkey for all badges is this content
		\dash\data::badge_shortkey(120);


		\dash\upload\size::set_default_file_size();
	}
}
?>