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

		$result = \lib\app\plan\planActiveate::activate($business_id, $args);

		\content_r10\tools::say($result);
	}
}
?>