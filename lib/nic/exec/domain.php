<?php
namespace lib\nic\exec;


class domain
{
	public static function create($_args)
	{
		return;
		$response = self::get_response_create($_args);
		var_dump($response);exit();
	}


	private static function get_response_create($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_create.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);
		$xml = str_replace('NS1.JIBRES.TLD', $_args['ns1'], $xml);
		$xml = str_replace('NS2.JIBRES.TLD', $_args['ns2'], $xml);
		$xml = str_replace('PERIOD', $_args['period'], $xml);

		// $xml = str_replace('JIBRES-NIC-ACCOUNT', \lib\nic\exec\run::jibres_nic_account(), $xml);
		$xml = str_replace('JIBRES-NIC-ACCOUNT', 'ex61-irnic', $xml);

		$insert_log =
		[
			'type'          => 'domain_create',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);


		if(\dash\url::isLocal())
		{
			$tracking_number = 'TEST-JIBRES-LOCAL-CHECK-'. $log_id;
		}
		else
		{
			$tracking_number = 'TEST-JIBRES-DOMAIN-CHECK-'. $log_id;
		}

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

		$object = new \SimpleXMLElement($response);

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}




	public static function check($_domain)
	{
		$check = self::analyze_domain_check($_domain);
		if(!$check || !is_array($check))
		{
			return false;
		}

		$detail = null;

		if(isset($check[$_domain]))
		{
			$detail = $check[$_domain];
		}

		$available = false;
		if(isset($detail['attr']['avail']) && $detail['attr']['avail'] == '1')
		{
			$available = true;
		}

		$result              = [];
		$result['available'] = $available;

		return $result;
	}



	private static function analyze_domain_check($_domain)
	{
		$objec_result = self::get_response_check($_domain);
		if(!$objec_result)
		{
			return false;
		}

		$result = [];
		if(!isset($objec_result->response->resData))
		{
			return false;
		}

		if(!$objec_result->response->resData->xpath('domain:chkData'))
		{
			return false;
		}

		foreach ($objec_result->response->resData->xpath('domain:chkData') as $domainchkData)
		{
			$temp = [];
			$myKey = null;
			foreach ($domainchkData->xpath('domain:cd') as $k => $v)
			{
				foreach ($v->xpath('domain:name') as $domainname)
				{
					$myKey = $domainname->__toString();
					$temp[$myKey]['name'] = $myKey;

					$attr             = $domainname->attributes();
					$attr             = (array) $attr;
					if(isset($attr['@attributes']))
					{
						$attr = $attr['@attributes'];
					}
					$temp[$myKey]['attr']   = $attr;
				}

				foreach ($v->xpath('domain:reason') as $domainreason)
				{
					$temp[$myKey]['reason'] = $domainreason->__toString();
				}

			}

			$result = array_merge($result, $temp);
		}

		return $result;
	}



	private static function get_response_check($_domain)
	{
		$addr = root. 'lib/nic/exec/samples/domain_check.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'domain_check',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);

		if(\dash\url::isLocal())
		{
			$tracking_number = 'TEST-JIBRES-LOCAL-CHECK-'. $log_id;
		}
		else
		{
			$tracking_number = 'TEST-JIBRES-DOMAIN-CHECK-'. $log_id;
		}

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

		$object = new \SimpleXMLElement($response);

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}


}
?>