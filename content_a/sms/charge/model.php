<?php

namespace content_a\sms\charge;

class model
{

	public static function post()
	{
		$args =
			[
				'amount'     => \dash\request::post('amount'),
				'turn_back'  => \dash\url::this(),
				'use_budget' => \dash\request::post('usebudget'),
			];


		\lib\app\sms_charge\charge::newPay($args);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}

}