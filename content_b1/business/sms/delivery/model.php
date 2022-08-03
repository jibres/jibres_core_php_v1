<?php
namespace content_b1\business\sms\delivery;


class model
{

	public static function post()
	{
		$result             = [];

		if(\dash\request::input_body('store_smslog_id') && \dash\request::input_body('status'))
		{
			\lib\app\sms\delivery::business_set_delivery(
                \dash\request::input_body('store_smslog_id'),
                \dash\request::input_body('status')
            );
		}
		\content_b1\tools::say($result);
	}
}
?>