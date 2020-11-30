<?php
namespace content_cms\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_("CMS"));
		\dash\data::dash_version(\dash\engine\version::get());
		\dash\data::dash_lastUpdate(\dash\utility\git::getLastUpdate());

		\dash\face::title(T_('Control Panel'). ' '. \dash\face::site());


		self::dashboard_detail();

	}



	private static function dashboard_detail()
	{
		$dashboard_detail = \dash\session::get('cpDashboardCache_'. \dash\language::current());
		if(!$dashboard_detail)
		{
			$dashboard_detail                   = [];
			$dashboard_detail['news']           = \dash\db\posts::get_count(['language' => \dash\language::current(), 'type' => 'post']);
			$dashboard_detail['pages']          = \dash\db\posts::get_count(['language' => \dash\language::current(), 'type' => 'page']);
			$dashboard_detail['cats']           = \dash\db\terms::get_count(['language' => \dash\language::current(), 'type' => 'cat']);
			$dashboard_detail['tags']           = \dash\db\terms::get_count(['language' => \dash\language::current(), 'type' => 'tag']);
			$dashboard_detail['helpcenter']     = \dash\db\posts::get_count(['language' => \dash\language::current(), 'type' => 'help']);
			$dashboard_detail['helpcentertags'] = \dash\db\terms::get_count(['language' => \dash\language::current(), 'type' => 'help_tag']);
			$dashboard_detail['supporttags']    = \dash\db\terms::get_count(['language' => \dash\language::current(), 'type' => 'support_tag']);
			$dashboard_detail['tickets']        = \dash\db\config::public_get_count('tickets', ['parent' => null]);
			$dashboard_detail['latesPost']      = \dash\app\posts::lates_post(['language' => \dash\language::current(), 'type' => 'post']);
			$dashboard_detail['latesHelp']      = \dash\app\posts::lates_post(['language' => \dash\language::current(), 'type' => 'help']);
			$dashboard_detail['latesTag']      = \dash\app\term::lates_term(['language' => \dash\language::current(), 'type' => 'tag']);


			$chart                     = [];
			$chart['post']             = \dash\app\dayevent::chart(['field' => ['news', 'page', 'help', 'attachment']]);
			$dashboard_detail['chart'] = $chart;

			// \dash\session::set('cpDashboardCache_'. \dash\language::current(), $dashboard_detail, null, (60*1));
		}

		\dash\data::dashboardDetail($dashboard_detail);
	}

}
?>