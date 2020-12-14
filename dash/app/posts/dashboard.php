<?php
namespace dash\app\posts;

class dashboard
{

	public static function detail()
	{

		$dashboard_detail              = [];
		$dashboard_detail['news']      = \dash\db\posts::get_count(['type' => 'post']);
		$dashboard_detail['pages']     = \dash\db\posts::get_count(['type' => 'page']);
		$dashboard_detail['cats']      = \dash\db\terms::get_count(['type' => 'cat']);
		$dashboard_detail['tags']      = \dash\db\terms::get_count(['type' => 'tag']);
		$dashboard_detail['comments']  = \dash\db\comments::get_count();
		$dashboard_detail['latesPost'] = \dash\app\posts\search::lates_post(['type' => 'post']);
		$dashboard_detail['latesTag']  = \dash\app\terms\get::lates_tag();

		return $dashboard_detail;


	}

}
?>