<?php
namespace content_r10\jibres\business_sms;


class view
{

	public static function config()
	{
		$business_id = \content_r10\tools::get_current_business_id();

		$result =
			[

				'budget'     => \dash\user::budget(),
				'currency'   => \lib\currency::unit(),
				'charge' => \lib\app\business_sms\charge::getBalance($business_id),
			];

		\content_r10\tools::say($result);

	}

}
