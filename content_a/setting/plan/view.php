<?php
namespace content_a\setting\plan;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Setting | '). T_('Change Plan of :name', ['name'=>\dash\data::store_name()]));
		\dash\data::page_desc(T_('Choose or change your plan'));

		$subchild = \dash\url::subchild();
		switch ($subchild)
		{
			case 'choose':
				\dash\data::myPlanDisplay('content_a/setting/plan/choosePlan.html');
				break;

			case 'start':
			case 'standard':
			case 'simple':
				\dash\data::isFirstYear(\lib\app\store\plan::is_first_year());
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