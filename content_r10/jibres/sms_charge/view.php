<?php
namespace content_r10\jibres\sms_charge;


class view
{

	public static function config()
	{

		$business_id = \content_r10\tools::get_current_business_id();

		if(\dash\request::get('list'))
		{
			$args =
				[
					'store_id' => $business_id,
				];

			$result = \lib\app\sms_charge\search::list(null, $args);
			$meta =
				[
					'is_filtered' => \lib\app\sms_charge\search::is_filtered(),
				];


			\dash\notif::meta($meta);
		}
		else
		{

			$result =
				[

					'budget'   => \dash\user::budget(),
					'currency' => \lib\currency::unit(),
					'charge'   => \lib\app\sms_charge\charge::getBalance($business_id),
				];
		}


		\content_r10\tools::say($result);

	}

}
