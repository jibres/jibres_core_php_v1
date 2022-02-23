<?php
namespace lib\app\sms;

class queue
{

	public static function add_one($_args)
	{
		$args = \lib\app\sms\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$myIp   = \dash\server::ip();
		$ip_id  = \dash\utility\ip::id($myIp);

		if(!a($args, 'status'))
		{
			$args['status']      = 'pending';
		}

		if(!a($args, 'type'))
		{
			$args['type']        = 'notif';
		}

		if(!a($args, 'mode'))
		{
			$args['mode']        = 'sms';
		}

		if(!$args['sender'])
		{
			$args['sender']      = 'customer';
		}

		$args['user_id']     = \dash\user::id();
		$args['url']         = \dash\url::pwd();
		$args['urlmd5']      = md5(\dash\url::pwd());
		$args['ip']          = $myIp;
		$args['ip_id']       = $ip_id;
		$args['agent_id']    = \dash\agent::get(true);
		$args['datecreated'] = date("Y-m-d H:i:s");

		if(a($args, 'token') || a($args, 'token2') || a($args, 'token3'))
		{
			$args['meta'] = json_encode(
			[
				'token' => a($args, 'token'),
				'token2' => a($args, 'token2'),
				'token3' => a($args, 'token3'),
			]);
		}

		$jibres_sms =
		[
			'store_smslog_id' => null,
			'mobile'          => a($args, 'mobile'),
			'message'         => a($args, 'message'),
			'sender'          => a($args, 'sender'),
			'len'             => a($args, 'len'),
			'smscount'        => a($args, 'smscount'),
			'status'          => a($args, 'status'),
			'type'            => a($args, 'type'),
			'mode'            => a($args, 'mode'),
			'token'           => a($args, 'token'),
			'token2'          => a($args, 'token2'),
			'token3'          => a($args, 'token3'),

		];

		unset($args['token']);
		unset($args['token2']);
		unset($args['token3']);

		$sms_store_smslog_id = \lib\db\sms_log\insert::new_record($args);

		if(!$sms_store_smslog_id)
		{
			// \dash\notif::error(T_("Can not add your sms"));
			return false;
		}

		$jibres_sms['store_smslog_id'] = $sms_store_smslog_id;

		$update_sms    = [];
		$jibres_sms_id = null;
		$new_status    = null;

		if(\dash\engine\store::inStore())
		{
			$jibres_sms['store_id'] = \lib\store::id();
			// curl to jibres to save
			$jibres_sms_result = \lib\api\jibres\api::add_store_sms($jibres_sms);

			if(isset($jibres_sms_result['result']['jibres_sms_id']) && is_numeric($jibres_sms_result['result']['jibres_sms_id']))
			{
				$jibres_sms_id = floatval($jibres_sms_result['result']['jibres_sms_id']);
			}

			if(isset($jibres_sms_result['result']['status']) && $jibres_sms_result['result']['status'])
			{
				$new_status = $jibres_sms_result['result']['status'];
			}
		}
		else
		{
			// save db
			$jibres_sms_result = self::add_new_sms_record($jibres_sms);
			$jibres_sms_id     = a($jibres_sms_result, 'id');
			$new_status        = a($jibres_sms_result, 'status');

		}

		if(in_array($new_status, ['register','pending','sending','expired','moneylow','unknown','send','sended','delivered','queue','failed','undelivered','cancel','block','other']))
		{
			$update_sms['status'] = $new_status;
		}

		// update local status from pending to register
		if(!$jibres_sms_id)
		{
			$update_sms['status'] = 'register';
		}
		else
		{
			$update_sms['jibres_sms_id'] = $jibres_sms_id;
		}

		if(!empty($update_sms))
		{
			\lib\db\sms_log\update::record($update_sms, $sms_store_smslog_id);
		}

		$result       = [];
		$result['id'] = $sms_store_smslog_id;

		// \dash\notif::ok(T_("Sms successfully added"));
		return $result;
	}


	/**
	 * Adds a new sms record.
	 * Call from api and self
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function add_new_sms_record($_args)
	{

		$condition =
		[
			'store_smslog_id' => 'id',
			'store_id'        => 'id',
			'mobile'          => 'mobile',
			'message'         => 'string',
			'sender'          => ['enum' => ['system', 'admin', 'customer']],
			'len'             => 'int',
			'smscount'        => 'int',
			'status'          => 'string',
			'type'            => 'string',
			'mode'            => 'string',
			'template'        => 'string',
			'token'           => 'string',
			'token2'          => 'string',
			'token3'          => 'string',


		];

		$require = ['mobile'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$add_sending_record = false;

		$jibres_sms =
		[
			'store_smslog_id' => a($data, 'store_smslog_id'),
			'mobile'          => a($data, 'mobile'),
			'store_id'        => a($data, 'store_id'),
			'message'         => a($data, 'message'),
			'sender'          => a($data, 'sender'),
			'len'             => a($data, 'len'),
			'smscount'        => a($data, 'smscount'),
			'status'          => a($data, 'status'),
			'type'            => a($data, 'type'),
			'mode'            => a($data, 'mode'),
			'datecreated'     => date("Y-m-d H:i:s"),
		];

		if(a($data, 'token') || a($data, 'token2') || a($data, 'token3'))
		{
			$jibres_sms['meta'] = json_encode(
			[
				'token'  => a($data, 'token'),
				'token2' => a($data, 'token2'),
				'token3' => a($data, 'token3'),
			]);
		}

		if(a($jibres_sms, 'store_id'))
		{
			// check store package remain
			$add_sending_record = \lib\app\sms\package::check($jibres_sms);
		}
		else
		{
			$add_sending_record = true;
		}

		$jibres_sms_id = \lib\db\sms\insert::new_record($jibres_sms);

		if($jibres_sms_id && $add_sending_record)
		{
			$sms_sending =
			[
				'sms_id'      => $jibres_sms_id,
				'status'      => 'pending',
				'datecreated' => date("Y-m-d H:i:s"),
			];

			\lib\db\sms\insert::new_record_sending($sms_sending);
		}
		else
		{
			// needless to add to sending table
		}

		$result =
		[
			'id'     => $jibres_sms_id,
			'status' => a($jibres_sms, 'status'),
		];

		return $result;
	}



	public static function send()
	{
		if(\dash\url::isLocal())
		{
			return false;
		}

		$limit = 20;
		// get 20 not sended sms
		$queue = \lib\db\sms_log\get::not_sended($limit);

		// no queue
		if(!$queue || !is_array($queue))
		{
			return;
		}

		$queue = array_map(['\\lib\\app\\sms\\ready', 'row'], $queue);

		$ids = array_column($queue, 'id');
		if($ids)
		{
			\lib\db\sms_log\update::set_multi_sending($ids);
		}

		foreach ($queue as $key => $sms)
		{
			if(isset($sms['mobile']) && isset($sms['message']))
			{
				if(a($sms, 'mode') === 'sms')
				{
					$option = [];

					if(isset($sms['sender']) && $sms['sender'] === 'admin')
					{
						$option['line'] = '10002000200251';
					}

					$sms_result = \lib\app\sms\send::send($sms['mobile'], $sms['message'], $option, $sms['id']);
				}
			}
		}

	}


	/**
	 * Sends a real time.
	 * Call every 1 secound
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function send_real_time()
	{
		if(!\dash\url::isLocal())
		{
			return;
		}
		// \dash\pdo::transaction('api_log');

		$get_sending_list = \lib\db\sms\get::not_sended_list();

		if(!is_array($get_sending_list))
		{
			$get_sending_list = [];
		}

		// nothing to send
		if(!$get_sending_list)
		{
			return false;
		}

		$ids = array_column($get_sending_list, 'id');

		// update all status of this list as sending to not load in another session
		// \lib\db\sms\update::set_sending_list(implode(',', $ids));

		$sms_ids = array_column($get_sending_list, 'sms_id');

		$sms_list = \lib\db\sms\get::by_multi_id(implode(',', $sms_ids));

		if(!is_array($sms_list))
		{
			$sms_list = [];
		}

		if(!$sms_list)
		{
			return false;
		}

		$normal_sms = [];
		$verification_sms = [];

		foreach ($sms_list as $key => $sms)
		{
			$sms_id = a($sms, 'id');

			if(a($sms, 'status') !== 'pending')
			{
				// sms was sended manually
				continue;
			}

			if(time() - strtotime($sms['datecreated']) > (60*60*12))
			{
				self::update_sms($sms_id, ['status' => 'expired']);
				continue;
			}

			if(isset($sms['mobile']) && isset($sms['message']) && a($sms, 'mode') === 'sms')
			{
				$normal_sms[] = $sms;
				continue;
			}

			if(a($sms, 'mode') === 'verification')
			{
				if(time() - strtotime($sms['datecreated']) > (60*6))
				{
					self::update_sms($sms_id, ['status' => 'expired']);
					continue;
				}

				$verification_sms[] = $sms;
				continue;
			}
		}
		var_dump($verification_sms, $normal_sms);
		var_dump($sms_list);exit;

		if($verification_sms)
		{

		}

		if($normal_sms)
		{
			foreach ($normal_sms as $key => $sms)
			{
				$option = [];

				if(isset($sms['sender']) && $sms['sender'] === 'admin')
				{
					$option['line'] = '10002000200251';
				}


				$sms_result = \lib\app\sms\send::send($sms['mobile'], $sms['message'], $option, $sms['id']);

				$provider_date = null;

				if(is_numeric(a($sms_result, 'date')))
				{
					$provider_date = date("Y-m-d H:i:s", strtotime($sms_result['date']));
				}

				$update_sms =
				[
					'status'             => 'sended',

					'provider'           => 'kavenegar',
					'response'           => json_encode($sms_result, true),
					'responsecode'      => 200,
					'provider_status'    => a($sms_result, 'status'),
					'provider_messageid' => a($sms_result, 'messageid'),
					'provider_sender'    => a($sms_result, 'sender'),
					'provider_receptor'  => a($sms_result, 'receptor'),
					'provider_date'      => $provider_date,
					'provider_cost'      => a($sms_result, 'cost'),
					'provider_currency'  => 'IRR',
				];

				self::update_sms($sms['id'], $update_sms);
			}
		}


		\lib\db\sms\delete::sending_by_multi_id(implode(',', $ids));

	}


	private static function update_sms($_id, $_update)
	{
		$defalt =
		[
			'datemodified' => date("Y-m-d H:i:s"),
		];

		$update = array_merge($defalt, $_update);

		\lib\db\sms\update::record($update, $_id);
	}

}
?>