<?php
namespace lib\nic\exec;


class contact_create
{

	public static function create($_args)
	{
		$create = self::analyze_contact_create($_args);

		if(!$create || !is_array($create))
		{
			return false;
		}

		if(!isset($create['id']))
		{
			return false;
		}

		$result                = [];
		$result['nic_id']      = $create['id'];
		$result['datecreated'] = isset($create['crDate']) ? date("Y-m-d H:i:s", strtotime($create['crDate'])) : null;

		return $result;
	}




	private static function analyze_contact_create($_args)
	{

		$object_result = self::get_response_create($_args);

		if(!$object_result)
		{
			return false;
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('contact:creData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('contact:creData') as  $contactcreData)
		{
			$temp  = [];

			foreach ($contactcreData->xpath('contact:id') as $contactid)
			{
				$myKey = $contactid->__toString();
				$temp['id']   = $myKey;
			}


			foreach ($contactcreData->xpath('contact:crDate') as $contactcrDate)
			{
				$temp['crDate']   = $contactcrDate->__toString();
			}

			$result = $temp;
		}

		return $result;
	}




	private static function get_response_create($_args)
	{
		$addr = root. 'lib/nic/exec/samples/contact_create.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$xml = str_replace('JIBRES-FIRSTNAME', 		$_args['firstname'], 	$xml);
		$xml = str_replace('JIBRES-LASTNAME', 		$_args['lastname'], 	$xml);
		$xml = str_replace('JIBRES-ADDRESS', 		$_args['address'], 		$xml);

		$xml = str_replace('JIBRES-CITY', 			$_args['city'], 		$xml);
		$xml = str_replace('JIBRES-PROVINCE', 		$_args['province'], 	$xml);
		$xml = str_replace('JIBRES-POSTALCODE', 	$_args['postcode'], 	$xml);
		$xml = str_replace('JIBRES-COUNTRY', 		$_args['country'], 		$xml);
		$xml = str_replace('JIBRES-MOBILE', 		$_args['mobile'], 		$xml);
		$xml = str_replace('JIBRES-NATIONALCODE', 	$_args['nationalcode'], $xml);
		$xml = str_replace('JIBRES-PASSPORTCODE', 	$_args['passportcode'], $xml);
		$xml = str_replace('JIBRES-SIGNATURE', 		$_args['signator'], 	$xml);
		$xml = str_replace('JIBRES-EMAIL', 			$_args['email'], 		$xml);

		$insert_log =
		[
			'type'          => 'contact_create',
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