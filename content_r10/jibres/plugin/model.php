<?php
namespace content_r10\jibres\plugin;


class model
{
	public static function post()
	{

		$business_id = \content_r10\tools::get_current_business_id();

		$args =
		[
			'plugin'     => \dash\request::input_body('plugin'),
			'periodic'   => \dash\request::input_body('periodic'),
			'package'    => \dash\request::input_body('package'),
			'use_budget' => \dash\request::input_body('use_budget'),
			'turn_back'  => \dash\request::input_body('turn_back'),
		];

		$result = \lib\app\plugin\activate::activate($business_id, $args);

		\content_r10\tools::say($result);
	}
}
?>