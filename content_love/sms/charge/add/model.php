<?php
namespace content_love\sms\charge\add;


class model
{

	public static function post()
	{
		$args =
			[
				'store_id' => \dash\request::get('business_id'),
				'amount'   => \dash\request::post('amount'),
				'type'     => \dash\request::post('type'),
				'desc'     => \dash\request::post('desc'),

			];

		\lib\app\sms_charge\charge::setManual($args);

		if(\dash\engine\process::status())
		{
			// return to list plan for this business
			\dash\redirect::to(\dash\url::that() . '?business_id=' . \dash\request::get('business_id'));
		}

	}

}
