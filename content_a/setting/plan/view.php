<?php
namespace content_a\setting\plan;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting | '). T_('Change Plan of :name', ['name'=>\dash\data::store_name()]));
		\dash\data::page_desc(T_('By choose new plan, we generate your invoice until now and next invoice is created one month later exactly at this time and you can pay it from billing.'));

		$subchild = \dash\url::subchild();
		switch ($subchild)
		{
			case 'choose':
				\dash\data::myPlanDisplay('content_a/setting/plan/choosePlan.html');
				break;

			case 'start':
			case 'standard':
			case 'simple':
				\dash\data::myPlanDisplay('content_a/setting/plan/choosePeriod.html');
				break;


			default:
				\dash\data::myPlanDisplay('content_a/setting/plan/currentPlanDetail.html');
				$plan_history = \lib\app\planhistory::list();
				\dash\data::dataTable($plan_history);
				break;
		}


	}
}
?>