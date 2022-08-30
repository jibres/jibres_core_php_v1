<?php
namespace content_a\plan\choose;


use lib\app\plan\planCheck;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Pick a plan"));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		// TODO need to set plan hashtag in help center
        \dash\face::help(\dash\url::support(). '/hashtag/plan');
		\dash\face::help(\dash\url::support());

		$args =
		[
			'period' => \dash\request::get('p'),
		];


		\dash\data::planList(\lib\app\plan\planList::listByDetail($args));

		// load budget from jibres api
		$my_jibres_budget = \lib\api\jibres\api::budget();
		\dash\data::myBudget($my_jibres_budget);

		\dash\data::myPlanDetail(\lib\app\plan\businessPlanDetail::getMyPlanHistoryDetail());

	}
}
?>
