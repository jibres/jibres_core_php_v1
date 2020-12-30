<?php
namespace dash\app\posts;

class dashboard
{

	public static function detail()
	{

		$dashboard_detail                      = [];
		$dashboard_detail['post']              = \dash\db\posts::get_active_count();

		$dashboard_detail['standard']          = \dash\db\posts::get_active_count_subtype('standard');
		$dashboard_detail['gallery']           = \dash\db\posts::get_active_count_subtype('gallery');
		$dashboard_detail['video']             = \dash\db\posts::get_active_count_subtype('video');
		$dashboard_detail['audio']             = \dash\db\posts::get_active_count_subtype('audio');

		$dashboard_detail['comments']          = \dash\db\comments::get_count();
		$dashboard_detail['comments_awaiting'] = \dash\db\comments::get_count(['status' => 'awaiting']);
		$dashboard_detail['comments_approved'] = \dash\db\comments::get_count(['status' => 'approved']);
		//
		$dashboard_detail['tags']              = \dash\db\terms\get::get_count(['type' => 'tag']);
		$dashboard_detail['latesPost']         = \dash\app\posts\search::lates_post();
		$dashboard_detail['latesComment']      = \dash\app\comment\search::lates_comment();


		return $dashboard_detail;


	}

}
?>