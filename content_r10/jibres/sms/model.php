<?php
namespace content_r10\jibres\sms;


class model
{
	public static function post()
	{
		$post = \dash\request::input_body();

		$jibres_sms =
		[
			'store_smslog_id' => a($post, 'store_smslog_id'),
			'store_id'        => \content_r10\tools::get_current_business_id(),
			'mobile'          => a($post, 'mobile'),
			'message'         => a($post, 'message'),
			'sender'          => a($post, 'sender'),
			'len'             => a($post, 'len'),
			'smscount'        => a($post, 'smscount'),
			'status'          => a($post, 'status'),
			'type'            => a($post, 'type'),
			'mode'            => a($post, 'mode'),
		];


		// save db
		$jibres_sms_result = \lib\app\sms\queue::add_new_sms_record($jibres_sms);

		$result =
		[
			'jibres_sms_id' => a($jibres_sms_result, 'id'),
			'status'        => a($jibres_sms_result, 'status'),
		];

		\content_r10\tools::say($result);

	}
}
?>