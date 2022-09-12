<?php
namespace content_a\plan\cancel;


use lib\app\plan\planCheck;

class view
{
	public static function config()
	{
		\lib\app\plan\businessPlanDetail::sync_required();

		\dash\face::title(T_("Cancel plan"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// TODO need to set plan hashtag in help center
        \dash\face::help(\dash\url::support(). '/hashtag/plan');
		\dash\face::help(\dash\url::support());


		\dash\data::myPlanDetail(\lib\app\plan\businessPlanDetail::getMyCurrentPlanDetail());

		$loadNewPlan =
			[
				'plan' => \dash\data::myPlan(),
				'action_type' => 'cancel',
			];

		$planFactor = \lib\app\plan\businessPlanDetail::calculateFactor($loadNewPlan);
		\dash\data::planFactor($planFactor);
	}
}

