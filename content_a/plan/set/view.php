<?php
namespace content_a\plan\set;


use lib\app\plan\planCheck;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Set plan"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/choose');

		// TODO need to set plan hashtag in help center
        \dash\face::help(\dash\url::support(). '/hashtag/plan');
		\dash\face::help(\dash\url::support());


		$loadNewPlan =
			[
				'plan'        => \dash\data::planName(),
				'period'      => \dash\request::get('p'),
				'business_id' => \lib\store::id(),
				'action_type' => 'register',
			];

		$planFactor = \lib\app\plan\businessPlanDetail::calculateFactor($loadNewPlan);

	}
}
?>
