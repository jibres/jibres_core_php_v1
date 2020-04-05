<?php
namespace lib\nic\exec;


class domain_transfer
{


	public static function transfer($_args)
	{
		$transfer = self::analyze_domain_transfer($_args);

		if(!$transfer || !is_array($transfer))
		{
			return false;
		}

		if(!isset($transfer['name']))
		{
			return false;
		}

		$result                 = [];
		$result['name']         = $transfer['name'];
		$result['dateregister'] = isset($transfer['crDate']) ? date("Y-m-d H:i:s", strtotime($transfer['crDate'])) : null;
		$result['dateexpire']  = isset($transfer['exDate']) ? date("Y-m-d H:i:s", strtotime($transfer['exDate'])) : null;

		return $result;
	}




	private static function analyze_domain_transfer($_args)
	{

		$object_result = self::get_response_transfer($_args);

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


	private static function get_response_transfer($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_transfer.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$xml = str_replace('JIBRES-PIN', $_args['pin'], $xml);

		$xml = str_replace('JIBRES-NIC-ACCOUNT', $_args['nic_id'], $xml);

		$insert_log =
		[
			'type'          => 'domain_transfer',
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
			$object = @new \SimpleXMLElement($response);
		}
		catch (\Exception $e)
		{
			// \dash\notif::error(T_("Can not connect to domain server"));
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