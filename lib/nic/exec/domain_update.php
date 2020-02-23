<?php
namespace lib\nic\exec;


class domain_update
{


	public static function update($_args)
	{
		$update = self::analyze_domain_update($_args);

		if(!$update || !is_array($update))
		{
			return false;
		}

		if(!isset($update['name']))
		{
			return false;
		}

		$result                 = [];
		$result['name']         = $update['name'];
		$result['dateregister'] = isset($update['crDate']) ? date("Y-m-d H:i:s", strtotime($update['crDate'])) : null;
		$result['dateexpire']  = isset($update['exDate']) ? date("Y-m-d H:i:s", strtotime($update['exDate'])) : null;

		return $result;
	}




	private static function analyze_domain_update($_args)
	{

		$object_result = self::get_response_update($_args);

		if(!$object_result)
		{
			return false;
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:creData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:creData') as  $domaincreData)
		{
			$temp  = [];

			foreach ($domaincreData->xpath('domain:name') as $domainname)
			{
				$myKey = $domainname->__toString();
				$temp['name']   = $myKey;
			}


			foreach ($domaincreData->xpath('domain:crDate') as $domaincrDate)
			{
				$temp['crDate']   = $domaincrDate->__toString();
			}

			foreach ($domaincreData->xpath('domain:exDate') as $domainexDate)
			{
				$temp['exDate']   = $domainexDate->__toString();
			}

			$result = $temp;
		}

		return $result;
	}


	private static function get_response_update($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_update.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		// NEW-NS1.JIBRES.TLD
		// NEW-NS2.JIBRES.TLD
		// OLD-NS1.JIBRES.TLD
		// OLD-NS2.JIBRES.TLD
		//
		// HOLDER-JIBRES-NIC-ACCOUNT
		// ADMIN-JIBRES-NIC-ACCOUNT
		// TECH-JIBRES-NIC-ACCOUNT
		// BILL-JIBRES-NIC-ACCOUNT

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);


		$insert_log =
		[
			'type'          => 'domain_update',
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


		if(!$response)
		{
			\dash\notif::error(T_("IRNIC server is not available at this time"));
			return false;
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