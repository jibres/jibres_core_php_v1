<?php
namespace content_r10\jibres\business_sms;


class view
{

	public static function config()
	{
		$result =
			[

				'budget'     => \dash\user::budget(),
				'currency'   => \lib\currency::unit(),
				'charge' => rand(100000, 900000000),
			];

		\content_r10\tools::say($result);

	}

}
