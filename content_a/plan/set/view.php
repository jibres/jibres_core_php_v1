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

		// // TODO need to set plan hashtag in help center
        // \dash\face::help(\dash\url::support(). '/hashtag/plan');
		// \dash\face::help(\dash\url::support());

		\dash\data::global_scriptPage("my_domain_review.js");

		$period = 'yearly';
		if(\dash\request::get('p'))
		{
			$period = \dash\request::get('p');
		}

		$actionType = 'register';
		if(\dash\request::get('renew'))
		{
			$actionType = 'renew';
		}

		$loadNewPlan =
			[
				'plan'        => \dash\data::planName(),
				'period'      => $period,
				'gift'        => \dash\request::get('gift'),
				'action_type' => $actionType,
			];

		$planFactor = \lib\app\plan\businessPlanDetail::calculateFactor($loadNewPlan);
		\dash\data::planFactor($planFactor);
	}
}

