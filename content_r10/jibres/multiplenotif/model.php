<?php
namespace content_r10\jibres\multiplenotif;


class model
{
	public static function post()
	{
		$post = \dash\request::input_body();

		if(is_array(a($post, 'telegram')))
		{
			foreach ($post['telegram'] as $key => $value)
			{
				if(isset($value['mobile']) && isset($value['telegram']['text']))
				{
					// save into telegram send
					\dash\app\telegram\queue::add_one($value['mobile'], $value['telegram'], ['store_id' => \content_r10\tools::get_current_business_id()]);
				}
			}
		}

		$result = ['ok'];

		// if(is_array(a($post, 'sms')))
		// {
		// 	foreach ($post['sms'] as $key => $value)
		// 	{
		// 		// code...
		// 	}
		// }
		// $jibres_sms =
		// [
		// 	'store_smslog_id' => a($post, 'store_smslog_id'),
		// 	'store_id'        => \content_r10\tools::get_current_business_id(),
		// 	'mobile'          => a($post, 'mobile'),
		// 	'message'         => a($post, 'message'),
		// 	'sender'          => a($post, 'sender'),
		// 	'len'             => a($post, 'len'),
		// 	'smscount'        => a($post, 'smscount'),
		// 	'status'          => a($post, 'status'),
		// 	'type'            => a($post, 'type'),
		// 	'mode'            => a($post, 'mode'),
		// 	'token'           => a($post, 'token'),
		// 	'token2'          => a($post, 'token2'),
		// 	'template'        => a($post, 'template'),
		// ];


		// // save db
		// $jibres_sms_result = \lib\app\sms\queue::add_new_sms_record($jibres_sms);

		// $result =
		// [
		// 	'jibres_sms_id' => a($jibres_sms_result, 'id'),
		// 	'status'        => a($jibres_sms_result, 'status'),
		// ];

		\content_r10\tools::say($result);

	}
}
?>