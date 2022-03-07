<?php
namespace content_r10\jibres\multiplenotif;


class model
{
	public static function post()
	{
		$post = \dash\request::input_body();

		$result =
		[
			'telegram' => [],
			'sms'      => [],
			'email'    => [],
		];


		if(is_array(a($post, 'telegram')))
		{
			foreach ($post['telegram'] as $key => $value)
			{
				if(isset($value['mobile']) && isset($value['telegram']['text']))
				{
					// save into telegram send
					$meta =
					[
						'store_id'   => \content_r10\tools::get_current_business_id(),
						'active_bot' => a($value, 'active_bot'),
					];

					$result['telegram'][] =
					[
						'args' => $value,
						'result' => \dash\app\telegram\queue::add_one($value['mobile'], $value['telegram'], $meta)
					];

					\dash\engine\process::continue();
				}
			}
		}


		if(is_array(a($post, 'sms')))
		{
			foreach ($post['sms'] as $key => $value)
			{
				$jibres_sms =
				[
					'store_smslog_id' => a($value, 'sms_param', 'store_smslog_id'),
					'store_id'        => \content_r10\tools::get_current_business_id(),
					'mobile'          => a($value, 'sms_param', 'mobile'),
					'message'         => a($value, 'sms_param', 'message'),
					'sender'          => a($value, 'sms_param', 'sender'),
					'len'             => a($value, 'sms_param', 'len'),
					'smscount'        => a($value, 'sms_param', 'smscount'),
					'status'          => a($value, 'sms_param', 'status'),
					'type'            => a($value, 'sms_param', 'type'),
					'mode'            => a($value, 'sms_param', 'mode'),
					'token'           => a($value, 'sms_param', 'token'),
					'token2'          => a($value, 'sms_param', 'token2'),
					'template'        => a($value, 'sms_param', 'template'),
				];

				$result['sms'][] =
				[
					'args'   => $value,
					'result' => \lib\app\sms\queue::add_new_sms_record($jibres_sms),
				];
				\dash\engine\process::continue();
			}
		}



		\content_r10\tools::say($result);

	}
}
?>