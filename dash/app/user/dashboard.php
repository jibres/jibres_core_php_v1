<?php
namespace dash\app\user;


class dashboard
{

	public static function detail()
	{
		$dashboard_detail                 = [];
		$dashboard_detail['users']        = \dash\db\users::get_count();
		$dashboard_detail['activeUser']   = \dash\db\users::get_count(['status' => 'active']);
		$dashboard_detail['permissions']  = count(\dash\permission::groups());
		$dashboard_detail['logs']         = \dash\db\logs::get_count();
		$dashboard_detail['latestLogs']   = \dash\app\log::lates_log(['caller' => 'userLogin']);
		$dashboard_detail['latestMember'] = \dash\app\user::lates_user();


		$get_chart                        = [];

		$chart                            = [];
		$chart['gender']                  = \dash\app\user::chart_gender($get_chart);
		$chart['status']                  = \dash\app\user::chart_status($get_chart);
		$chart['log']                     = \dash\app\log::chart_log_date($get_chart);
		$chart['dayevent']                = \dash\app\dayevent::chart(['field' => ['activeuser', 'deactiveuser', 'user_awaiting', 'user_removed', 'user_filter']]);


		$identify                         = \dash\app\user::chart_identify($get_chart, true);
		$chart['identify']                = $identify['chart'];
		$dashboard_detail['identifyNumber'] = $identify['raw'];
		if(!isset($dashboard_detail['identifyNumber']['mobile']))
		{
			$dashboard_detail['identifyNumber']['mobile'] = 0;
		}

		if(!isset($dashboard_detail['identifyNumber']['chatid']))
		{
			$dashboard_detail['identifyNumber']['chatid'] = 0;
		}

		if(!isset($dashboard_detail['identifyNumber']['android']))
		{
			$dashboard_detail['identifyNumber']['android'] = 0;
		}

		$dashboard_detail['chart'] = $chart;

		return $dashboard_detail;
	}

}
?>