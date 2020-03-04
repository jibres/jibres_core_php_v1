<?php
namespace lib\nic\exec;


class domain_info
{

	public static function info($_domain)
	{
		$info = self::analyze_domain_info($_domain);
		if(!$info || !is_array($info))
		{
			return false;
		}

		return $info;
	}




	private static function analyze_domain_info($_domain)
	{

		$object_result = self::get_response_info($_domain);

		if(!$object_result)
		{
			return false;
		}

		if(\lib\nic\exec\run::result_code($object_result) === '2303')
		{
			// error object not found and check domain is available so this domain is rejected
			$check_domain = \lib\nic\exec\domain_check::check($_domain);
			if(isset($check_domain['available']) && $check_domain['available'])
			{
				return ['status' => ['irnicRegistrationRejected']];
			}
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:infData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:infData') as  $domaininfData)
		{
			$temp  = [];
			$myKey = null;

			foreach ($domaininfData->xpath('domain:name') as $domainname)
			{
				$myKey = $domainname->__toString();
				$temp[$myKey]['name']   = $myKey;
			}


			foreach ($domaininfData->xpath('domain:roid') as $domainroid)
			{
				$temp[$myKey]['roid']   = $domainroid->__toString();
			}


			foreach ($domaininfData->xpath('domain:crDate') as $domaincrDate)
			{
				$temp[$myKey]['crDate']   = $domaincrDate->__toString();
			}

			foreach ($domaininfData->xpath('domain:upDate') as $domainupDate)
			{
				$temp[$myKey]['upDate']   = $domainupDate->__toString();
			}

			foreach ($domaininfData->xpath('domain:exDate') as $domainexDate)
			{
				$temp[$myKey]['exDate']   = $domainexDate->__toString();
			}

			foreach ($domaininfData->xpath('domain:status') as $domainstatus)
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



			foreach ($domaininfData->xpath('domain:contact') as $domaincontact)
			{
				$attr             = $domaincontact->attributes();
				$attr             = (array) $attr;

				if(isset($attr['@attributes']))
				{
					$attr = $attr['@attributes'];
				}

				if(isset($attr['type']))
				{
					$temp[$myKey][$attr['type']] = $domaincontact->__toString();
				}
			}

			foreach ($domaininfData->xpath('domain:ns') as $domainns)
			{

				foreach ($domainns->xpath('domain:hostAttr') as $hostAttr)
				{
					foreach ($hostAttr->xpath('domain:hostName') as $hostName)
					{
						$temp[$myKey]['ns'][]   = $hostName->__toString();
					}

					foreach ($hostAttr->xpath('domain:hostAddr') as $hostAddr)
					{
						$temp[$myKey]['ip'][]   = $hostAddr->__toString();
					}
				}
			}

			$result = $temp;
		}

		return $result;
	}



	private static function get_response_info($_domain)
	{
		$addr = root. 'lib/nic/exec/samples/domain_info.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'domain_info',
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
			$object = new \SimpleXMLElement($response);
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