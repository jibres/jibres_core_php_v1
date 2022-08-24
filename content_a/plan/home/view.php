<?php
namespace content_a\plan\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Pick a plan"));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$args =
		[
			'period' => \dash\request::get('p'),
		];

		\dash\data::planList(\lib\app\plan\planList::listByDetail($args));

		// load budget from jibres api
		$my_jibres_budget = \lib\api\jibres\api::budget();
		\dash\data::myBudget($my_jibres_budget);

		\dash\data::myPlanDetail(\lib\app\plan\businessPlanDetail::getMyPlanDetail());

	}
}
?>
