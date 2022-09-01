<?php
namespace content_r10\jibres\plan;


class model
{
	public static function post()
	{

		$business_id = \content_r10\tools::get_current_business_id();

		$args =
		[
			'plan'       => \dash\request::input_body('plan'),
			'period'     => \dash\request::input_body('period'),
			'use_budget' => \dash\request::input_body('use_budget'),
			'turn_back'  => \dash\request::input_body('turn_back'),
		];

		$result = \lib\app\plan\storePlan::activate($business_id, $args);

		\content_r10\tools::say($result);
	}


	public static function delete()
	{
		$business_id = \content_r10\tools::get_current_business_id();

		$result = \lib\app\plan\storePlan::doCancel($business_id);

		\content_r10\tools::say($result);
	}
}
?>