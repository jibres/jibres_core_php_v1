<?php
namespace content_cms\home;

class view
{

	public static function config()
	{
		\dash\data::dash_version(\dash\engine\version::get());
		\dash\data::dash_lastUpdate(\dash\utility\git::getLastUpdate());

		\dash\face::title(T_('CMS'));

		\dash\data::back_text(T_("Dashboard"));
		\dash\data::back_link(\dash\url::kingdom(). '/a');


		self::dashboard_detail();

	}



	private static function dashboard_detail()
	{

		$dashboard_detail              = [];
		$dashboard_detail['news']      = \dash\db\posts::get_count(['type' => 'post']);
		$dashboard_detail['pages']     = \dash\db\posts::get_count(['type' => 'page']);
		$dashboard_detail['cats']      = \dash\db\terms::get_count(['type' => 'cat']);
		$dashboard_detail['tags']      = \dash\db\terms::get_count(['type' => 'tag']);
		$dashboard_detail['latesPost'] = \dash\app\posts::lates_post(['type' => 'post']);
		$dashboard_detail['latesTag']  = \dash\app\term::lates_term(['type' => 'tag']);


		\dash\data::dashboardDetail($dashboard_detail);
	}

}
?>