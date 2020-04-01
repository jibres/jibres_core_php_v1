<?php
namespace lib\nic\exec;


class contact_check
{

	public static function check($_contact)
	{
		$check = self::analyze_contact_check($_contact);
		if(!$check || !is_array($check))
		{
			return false;
		}

		return $check;
	}


	private static function analyze_contact_check($_contact)
	{

		$object_result = self::get_response_check($_contact);

		if(!$object_result)
		{
			return false;
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}


		if(!$object_result->response->resData->xpath('contact:chkData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('contact:chkData') as  $contactchkData)
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





	private static function get_response_check($_contact)
	{
		$addr = root. 'lib/nic/exec/samples/contact_check.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-CHECK', $_contact, $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'contact_check',
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
			\dash\notif::error(T_("Can not connect to domain server"));
			\lib\db\nic_log\update::update($update_after_send, $log_id);
			return false;
		}

		$result_code = \lib\nic\exec\run::result_code($object);

		$update_after_send['result_code'] = $result_code;
		$update_after_send['server_id']   = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		if($result_code != 1000)
		{
			\dash\notif::error(\lib\nic\exec\run::code_msg($result_code));
		}

		return $object;

	}
}
?>