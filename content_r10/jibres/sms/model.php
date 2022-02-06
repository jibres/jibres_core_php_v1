<?php
namespace content_r10\jibres\sms;


class model
{
	public static function post()
	{
		$post = \dash\request::input_body();

		$jibres_sms =
		[
			'local_id'    => a($post, 'local_id'),
			'store_id'    => \content_r10\tools::get_current_business_id(),
			'mobile'      => a($post, 'mobile'),
			'message'     => a($post, 'message'),
			'sender'      => a($post, 'sender'),
			'len'         => a($post, 'len'),
			'smscount'    => a($post, 'smscount'),
			'status'      => a($post, 'status'),
			'type'        => a($post, 'type'),
			'mode'        => a($post, 'mode'),
		];

		// save db
		$jibres_sms_id = \lib\db\sms\insert::new_record($jibres_sms);

		$result = ['jibres_sms_id' => $jibres_sms_id];

		\content_r10\tools::say($result);

	}
}
?>