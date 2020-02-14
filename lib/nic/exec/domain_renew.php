<?php
namespace lib\nic\exec;


class domain_renew
{


	public static function renew($_args)
	{
		$renew = self::analyze_domain_renew($_args);

		if(!$renew || !is_array($renew))
		{
			return false;
		}

		if(!isset($renew['name']))
		{
			return false;
		}

		$result                 = [];
		$result['name']         = $renew['name'];
		$result['dateregister'] = isset($renew['crDate']) ? date("Y-m-d H:i:s", strtotime($renew['crDate'])) : null;
		$result['dateexpire']  = isset($renew['exDate']) ? date("Y-m-d H:i:s", strtotime($renew['exDate'])) : null;

		return $result;
	}




	private static function analyze_domain_renew($_args)
	{

		$object_result = self::get_response_renew($_args);

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


	private static function get_response_renew($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_renew.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}


		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$xml = str_replace('PERIOD', $_args['period'], $xml);
		$xml = str_replace('JIBRES-EXPIRE-DATE', $_args['expiredate'], $xml);

		$insert_log =
		[
			'type'          => 'domain_renew',
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

		$object = new \SimpleXMLElement($response);

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}




}
?>