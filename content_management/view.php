<?php
namespace content_management;


class view
{
	public static function config()
	{
		\dash\face::site(T_("Jibres Management"));
		\dash\data::site_desc(T_("Jibres is not just an online accounting software;"). ' '.  T_("We try to create the best financial platform that has everything you need to sale and manage your financial life."));
		\dash\data::site_slogan(T_("Integrated Sales and Online Accounting"));


		\dash\data::include_adminPanel(true);
		\dash\data::include_highcharts(true);
	}
}
?>
