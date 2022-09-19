<?php
namespace content_r10\jibres\sms_charge;


class model
{

	public static function post()
	{

		$business_id = \content_r10\tools::get_current_business_id();

		$args =
			[

				'amount'     => \dash\request::input_body('amount'),
				'use_budget' => \dash\request::input_body('use_budget'),
				'turn_back'  => \dash\request::input_body('turn_back'),

			];

		$result = \lib\app\sms_charge\charge::pay($business_id, $args);

		\content_r10\tools::say($result);

	}

}