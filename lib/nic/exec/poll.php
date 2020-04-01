<?php
namespace lib\nic\exec;


class poll
{

	public static function request()
	{
		$poll = self::analyze_poll_request();
		return $poll;
	}


	public static function acknowledge($_id)
	{
		$result = self::analyze_poll_acknowledge($_id);
		return $result;
	}

	private static function analyze_poll_acknowledge($_id)
	{
		$addr = root. 'lib/nic/exec/samples/poll_ack.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}


		$xml = str_replace('JIBRES-POLL-ID', $_id, $xml);

		$insert_log =
		[
			'type'          => 'poll_acknowledge',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);

		$tracking_number = \lib\nic\exec\run::make_tracking_number($log_id, get_class());

		$xml = str_replace('JIBRES-TRACKING-NUMBER', $tracking_number, $xml);

		$update_befor_send =
		[
			'send'      => addslashes($xml),
			'client_id' => $tracking_number,
		];

		\lib\db\nic_log\update::update($update_befor_send, $log_id);

		$response = \lib\nic\exec\run::send($xml);

		$update_after_send = [];

		$update_after_send['dateresponse'] = date("Y-m-d H:i:s");

		if(isset($response))
		{
			$update_after_send['response'] = addslashes($response);
		}


		try
		{
			$object = @new \SimpleXMLElement($response);
		}
		catch (\Exception $e)
		{
			\dash\notif::error(T_("Can not connect to domain server"));
			\lib\db\nic_log\update::update($update_after_send, $log_id);
			return false;
		}

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}





	private static function analyze_poll_request()
	{


		$object_result = self::get_poll_request();

		if(!$object_result)
		{
			return false;
		}

		// no new poll
		if(\lib\nic\exec\run::result_code($object_result) !== '1301')
		{
			return null;
		}

		$result = [];

		if(!isset($object_result->response->msgQ))
		{
			return false;
		}



		$attr             = $object_result->response->msgQ->attributes();
		$attr             = (array) $attr;

		if(isset($attr['@attributes']))
		{
			$attr = $attr['@attributes'];
		}

		if(isset($attr['count']))
		{
			$result['count']   = $attr['count'];
		}

		if(isset($attr['id']))
		{
			$result['id']   = $attr['id'];
		}

		if(isset($object_result->response->msgQ->msg))
		{
			foreach ($object_result->response->msgQ->msg as  $msg)
			{
				foreach ($msg->xpath('index') as $index)
				{
					$result['index'] = $index->__toString();
				}

				foreach ($msg->xpath('note') as $note)
				{
					$result['note'] = $note->__toString();
				}
			}
		}



		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:polData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:polData') as  $domainpolData)
		{
			$temp  = [];
			$myKey = null;

			foreach ($domainpolData->xpath('domain:name') as $domainname)
			{
				$myKey = $domainname->__toString();
				$result['domain'] = $myKey;
				$temp[$myKey]['id']   = $myKey;
			}


			foreach ($domainpolData->xpath('domain:roid') as $domainroid)
			{
				$temp[$myKey]['roid']   = $domainroid->__toString();
			}

			foreach ($domainpolData->xpath('domain:status') as $domainstatus)
			{
				$attr             = $domainstatus->attributes();
				$attr             = (array) $attr;

				if(isset($attr['@attributes']))
				{
					$attr = $attr['@attributes'];
				}

				if(isset($attr['s']))
				{
					$temp[$myKey]['status'][]   = $attr['s'];
				}

			}

			$result['detail'] = $temp;
		}

		return $result;
	}



	private static function get_poll_request()
	{
		$addr = root. 'lib/nic/exec/samples/poll_req.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'poll_request',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);

		$tracking_number = \lib\nic\exec\run::make_tracking_number($log_id, get_class());

		$xml = str_replace('JIBRES-TRACKING-NUMBER', $tracking_number, $xml);

		$update_befor_send =
		[
			'send'      => addslashes($xml),
			'client_id' => $tracking_number,
		];

		\lib\db\nic_log\update::update($update_befor_send, $log_id);

		$response = \lib\nic\exec\run::send($xml);

		$update_after_send = [];

		$update_after_send['dateresponse'] = date("Y-m-d H:i:s");

		if(isset($response))
		{
			$update_after_send['response'] = addslashes($response);
		}


		try
		{
			$object = @new \SimpleXMLElement($response);
		}
		catch (\Exception $e)
		{
			\dash\notif::error(T_("Can not connect to domain server"));
			\lib\db\nic_log\update::update($update_after_send, $log_id);
			return false;
		}

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}


}
?>