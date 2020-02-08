<?php
namespace lib\nic\exec;


class contact_info
{

	public static function info($_contact)
	{
		$info = self::analyze_contact_info($_contact);
		if(!$info || !is_array($info))
		{
			return false;
		}

		return $info;
	}




	private static function analyze_contact_info($_contact)
	{

		$objec_result = self::get_response_info($_contact);

		if(!$objec_result)
		{
			return false;
		}

		$result = [];
		if(!isset($objec_result->response->resData))
		{
			return false;
		}


		if(!$objec_result->response->resData->xpath('contact:chkData'))
		{
			return false;
		}

		foreach ($objec_result->response->resData->xpath('contact:chkData') as  $contactchkData)
		{
			$temp  = [];
			$myKey = null;
			foreach ($contactchkData->xpath('contact:cd') as $k => $contactcd)
			{
				foreach ($contactcd->xpath('contact:id') as $contactid)
				{
					$myKey = $contactid->__toString();
					$temp[$myKey]['id']   = $myKey;

					$attr             = $contactid->attributes();
					$attr             = (array) $attr;
					if(isset($attr['@attributes']))
					{
						$attr = $attr['@attributes'];
					}
					if(isset($attr['avail']))
					{
						$temp[$myKey]['avail']   = $attr['avail'];
					}
				}

				foreach ($contactcd->xpath('contact:position') as $contactposition)
				{
					$attr             = $contactposition->attributes();
					$attr             = (array) $attr;

					if(isset($attr['@attributes']))
					{
						$attr = $attr['@attributes'];
					}

					if(isset($attr['type']) && isset($attr['allowed']))
					{
						$temp[$myKey][$attr['type']] = $attr['allowed'];
					}
				}
			}

			$result = $temp;
		}

		return $result;
	}



	private static function get_response_info($_contact)
	{
		$addr = root. 'lib/nic/exec/samples/contact_info.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-INFO', $_contact, $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'contact_info',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);

		if(\dash\url::isLocal())
		{
			$tracking_number = 'TEST-JIBRES-LOCAL-INFO-'. $log_id;
		}
		else
		{
			$tracking_number = 'TEST-JIBRES-DOMAIN-INFO-'. $log_id;
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