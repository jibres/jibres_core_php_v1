<?php
namespace content_subdomain\home;


class view
{
	public static function config()
	{
		\dash\data::site_title(T_("Jibres"));
		\dash\data::site_desc(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));


		\dash\data::bodyclass('unselectable flex align-center justify-center txtC');
		\dash\data::include_js(false);
	}
}
?>