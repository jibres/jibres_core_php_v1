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

		$args['status']      = 'pending';
		$args['type']        = 'notif';
		$args['mode']        = 'sms';

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

		$sms_local_id = \lib\db\sms_log\insert::new_record($args);

		if(!$sms_local_id)
		{
			// \dash\notif::error(T_("Can not add your sms"));
			return false;
		}

		$jibres_sms =
		[
			'local_id'    => $sms_local_id,
			'mobile'      => a($args, 'mobile'),
			'message'     => a($args, 'message'),
			'sender'      => a($args, 'sender'),
			'len'         => a($args, 'len'),
			'smscount'    => a($args, 'smscount'),
			'status'      => a($args, 'status'),
			'type'        => a($args, 'type'),
			'mode'        => a($args, 'mode'),
		];

		// if(\dash\engine\store::inStore())
		// {
		// 	$jibres_sms['store_id'] = \lib\store::id();
		// 	// curl to jibres to save
		// 	$jibres_sms_result = \lib\api\jibres\api::add_store_sms($jibres_sms);
		// }
		// else
		// {
		// 	// save db
		// 	\lib\db\store_sms\insert::new_record($jibres_sms);
		// }

		$result       = [];
		$result['id'] = $sms_local_id;

		// \dash\notif::ok(T_("Sms successfully added"));
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
?>