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


		$sms_store_smslog_id = \lib\db\sms_log\insert::new_record($args);

		if(!$sms_store_smslog_id)
		{
			// \dash\notif::error(T_("Can not add your sms"));
			return false;
		}

		$jibres_sms =
		[
			'store_smslog_id'    => $sms_store_smslog_id,
			'mobile'      => a($args, 'mobile'),
			'message'     => a($args, 'message'),
			'sender'      => a($args, 'sender'),
			'len'         => a($args, 'len'),
			'smscount'    => a($args, 'smscount'),
			'status'      => a($args, 'status'),
			'type'        => a($args, 'type'),
			'mode'        => a($args, 'mode'),
		];

		$jibres_sms_id = null;
		if(\dash\engine\store::inStore())
		{
			$jibres_sms['store_id'] = \lib\store::id();
			// curl to jibres to save
			$jibres_sms_result = \lib\api\jibres\api::add_store_sms($jibres_sms);

			if(isset($jibres_sms_result['result']['jibres_sms_id']) && is_numeric($jibres_sms_result['result']['jibres_sms_id']))
			{
				$jibres_sms_id = floatval($jibres_sms_result['result']['jibres_sms_id']);
			}
		}
		else
		{
			// save db
			$jibres_sms_id = self::add_new_sms_record($jibres_sms);
		}

		$update_sms = [];
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
			\dash\log::oops('errorAddNewSMS');
		}

		return $jibres_sms_id;
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


}
?>