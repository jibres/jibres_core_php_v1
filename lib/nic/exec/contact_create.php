<?php
namespace lib\nic\exec;


class contact_create
{

	public static function create($_args)
	{
		$create = self::analyze_contact_create($_args);
		j($create);
		if(!$create || !is_array($create))
		{
			return false;
		}

		return $create;
	}




	private static function analyze_contact_create($_args)
	{

		$objec_result = self::get_response_create($_args);

		if(!$objec_result)
		{
			return false;
		}

		$result = [];
		if(!isset($objec_result->response->resData))
		{
			return false;
		}

		if(!$objec_result->response->resData->xpath('contact:infData'))
		{
			return false;
		}

		foreach ($objec_result->response->resData->xpath('contact:infData') as  $contactinfData)
		{
			$temp  = [];
			$myKey = null;

			foreach ($contactinfData->xpath('contact:id') as $contactid)
			{
				$myKey = $contactid->__toString();
				$temp[$myKey]['id']   = $myKey;
			}


			foreach ($contactinfData->xpath('contact:roid') as $contactroid)
			{
				$temp[$myKey]['roid']   = $contactroid->__toString();
			}

			foreach ($contactinfData->xpath('contact:voice') as $contactvoice)
			{
				$temp[$myKey]['mobile']   = $contactvoice->__toString();
			}

			foreach ($contactinfData->xpath('contact:signature') as $contactsignature)
			{
				$temp[$myKey]['signature']   = $contactsignature->__toString();
			}

			foreach ($contactinfData->xpath('contact:email') as $contactemail)
			{
				$temp[$myKey]['email']   = $contactemail->__toString();
			}

			foreach ($contactinfData->xpath('contact:crDate') as $contactcrDate)
			{
				$temp[$myKey]['datecreated']   = $contactcrDate->__toString();
			}


			foreach ($contactinfData->xpath('contact:status') as $contactstatus)
			{
				$attr             = $contactstatus->attributes();
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

			foreach ($contactinfData->xpath('contact:position') as $contactposition)
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

			foreach ($contactinfData->xpath('contact:postalInfo') as $contactpostalInfo)
			{

				foreach ($contactpostalInfo->xpath('contact:org') as $contactorg)
				{
					$temp[$myKey]['company']   = $contactorg->__toString();
				}

				foreach ($contactpostalInfo->xpath('contact:addr') as $contactaddr)
				{
					foreach ($contactaddr->xpath('contact:street') as $contactstreet)
					{
						$temp[$myKey]['address']   = $contactstreet->__toString();
					}

					foreach ($contactaddr->xpath('contact:city') as $contactcity)
					{
						$temp[$myKey]['city']   = $contactcity->__toString();
					}

					foreach ($contactaddr->xpath('contact:sp') as $contactsp)
					{
						$temp[$myKey]['province']   = $contactsp->__toString();
					}

					foreach ($contactaddr->xpath('contact:pc') as $contactpc)
					{
						$temp[$myKey]['postalcode']   = $contactpc->__toString();
					}

					foreach ($contactaddr->xpath('contact:cc') as $contactcc)
					{
						$temp[$myKey]['country']   = $contactcc->__toString();
					}
				}
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

		if(\dash\url::isLocal())
		{
			$tracking_number = 'TEST-JIBRES-LOCAL-CREATE-'. $log_id;
		}
		else
		{
			$tracking_number = 'TEST-JIBRES-DOMAIN-CREATE-'. $log_id;
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

		if(!$response)
		{
			\dash\notif::error(T_("IRNIC server is not available at this time"));
			return false;
		}

		$object = new \SimpleXMLElement($response);

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