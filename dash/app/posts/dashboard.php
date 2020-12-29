<?php
namespace dash\app\posts;

class dashboard
{

	public static function detail()
	{

		$dashboard_detail              = [];
		$dashboard_detail['post']      = \dash\db\posts::get_count();
		$dashboard_detail['tags']      = \dash\db\terms\get::get_count(['type' => 'tag']);
		$dashboard_detail['comments']  = \dash\db\comments::get_count();
		$dashboard_detail['latesPost'] = \dash\app\posts\search::lates_post();
		$dashboard_detail['latesTag']  = \dash\app\terms\get::lates_tag();

		return $dashboard_detail;


	}

}
?>