<?php
namespace content_cms\home;

class view
{

	public static function config()
	{

		\dash\data::dash_version(\dash\engine\version::get());
		\dash\data::dash_lastUpdate(\dash\utility\git::getLastUpdate());

		\dash\face::title(T_('Control Panel'). ' '. \dash\data::site_title());


		self::dashboard_detail();
		self::dashboard_detail_no_lang();
		self::all_word_cloud();
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
			$chart['post']             = \dash\utility\dayevent::chart(['field' => ['news', 'page', 'help', 'attachment']]);
			$dashboard_detail['chart'] = $chart;

			// \dash\session::set('cpDashboardCache_'. \dash\language::current(), $dashboard_detail, null, (60*1));
		}

		\dash\data::dashboardDetail($dashboard_detail);
	}


	private static function dashboard_detail_no_lang()
	{

		$dashboard_detail_no_lang = \dash\session::get('cpDashboardCacheNoLang_'. \dash\language::current());
		if(!$dashboard_detail_no_lang)
		{
			$dashboard_detail_no_lang                   = [];
			$dashboard_detail_no_lang['news']           = \dash\db\posts::get_count(['type' => 'post']);
			$dashboard_detail_no_lang['pages']          = \dash\db\posts::get_count(['type' => 'page']);
			$dashboard_detail_no_lang['cats']           = \dash\db\terms::get_count(['type' => 'cat']);
			$dashboard_detail_no_lang['tags']           = \dash\db\terms::get_count(['type' => 'tag']);
			$dashboard_detail_no_lang['helpcenter']     = \dash\db\posts::get_count(['type' => 'help']);
			$dashboard_detail_no_lang['helpcentertags'] = \dash\db\terms::get_count(['type' => 'help_tag']);
			$dashboard_detail_no_lang['supporttags']    = \dash\db\terms::get_count(['type' => 'support_tag']);
			$dashboard_detail_no_lang['latesPost']      = \dash\app\posts::lates_post(['type' => 'post']);
			$dashboard_detail_no_lang['latesHelp']      = \dash\app\posts::lates_post(['type' => 'help']);
			$dashboard_detail_no_lang['latesTag']      = \dash\app\term::lates_term(['type' => 'tag']);
			// \dash\session::set('cpDashboardCacheNoLang_'. \dash\language::current(), $dashboard_detail_no_lang, null, (60*1));
		}

		\dash\data::dashboardDetailNoLang($dashboard_detail_no_lang);
	}


	private static function all_word_cloud()
	{
		$args             = [];
		$args['language'] = \dash\language::current();

	}
}
?>