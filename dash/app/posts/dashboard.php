<?php
namespace dash\app\posts;

class dashboard
{

	public static function detail()
	{

		$total_post = floatval(\dash\db\posts::get_active_count());

		$dashboard_detail                           = [];

		$dashboard_detail['post']                   = $total_post;

		$dashboard_detail['standard']               = floatval(\dash\db\posts::get_active_count_subtype('standard'));
		$dashboard_detail['gallery']                = floatval(\dash\db\posts::get_active_count_subtype('gallery'));
		$dashboard_detail['video']                  = floatval(\dash\db\posts::get_active_count_subtype('video'));
		$dashboard_detail['audio']                  = floatval(\dash\db\posts::get_active_count_subtype('audio'));

		$dashboard_detail['comments']               = floatval(\dash\db\comments::get_count());
		$dashboard_detail['comments_awaiting']      = floatval(\dash\db\comments::get_count(['status' => 'awaiting']));
		$dashboard_detail['comments_approved']      = floatval(\dash\db\comments::get_count(['status' => 'approved']));
		//
		$dashboard_detail['tags']                   = floatval(\dash\db\terms\get::get_count(['type' => 'tag']));
		$dashboard_detail['latesPost']              = \dash\app\posts\search::lates_post();
		$dashboard_detail['latesComment']           = \dash\app\comment\search::lates_comment();

		if(!$total_post)
		{
			$total_post = 1;
		}

		$specialaddress_percent = floatval(\dash\db\posts::get_count_special_address());
		$specialaddress_percent = round(($specialaddress_percent * 100) / $total_post);

		$havecover_percent      = floatval(\dash\db\posts::get_count_have_cover());
		$havecover_percent      = round(($havecover_percent * 100) / $total_post);

		$publish_percent        = floatval(\dash\db\posts::get_count_published());
		$publish_percent        = round(($publish_percent * 100) / $total_post);


		$dashboard_detail['specialaddress_percent'] = $specialaddress_percent;
		$dashboard_detail['havecover_percent']      = $havecover_percent;
		$dashboard_detail['publish_percent']        = $publish_percent;

		return $dashboard_detail;


	}

}
?>