<?php
namespace lib\nic\exec;


class domain_check
{

	public static function multi_check($_domains)
	{
		$check = self::analyze_domain_check($_domains);

		if(!$check || !is_array($check))
		{
			return false;
		}

		$result = [];
		foreach ($check as $key => $value)
		{
			$result[$key]         = [];
			$result[$key]['name'] = $key;
			if(isset($value['attr']['avail']))
			{
				$result[$key]['available'] = boolval($value['attr']['avail']);
			}

			$result[$key]['price'] = \lib\app\nic_domain\price::register('1year');
			$result[$key]['compareAtPrice'] = \lib\app\nic_domain\price::register_compare('1year');
			$result[$key]['unit'] = T_('Toman');

			if(isset($value['attr']['normalized_name']))
			{
			$result[$key]['name'] = $value['attr']['normalized_name'];
			}

			if(isset($value['attr']['tld']))
			{
				$result[$key]['tld'] = $value['attr']['tld'];
				// set paperwork access for tld
				switch ($value['attr']['tld'])
				{
					case 'id.ir':
						$result[$key]['paperwork'] = T_('irnic person');
						break;

					case 'co.ir':
					case 'net.ir':
						$result[$key]['paperwork'] = T_('irnic private');
						break;

					case 'gov.ir':
					case 'co.ir':
						$result[$key]['paperwork'] = T_('irnic gov');
						break;

					case 'sch.ir':
					case 'ac.ir':
						$result[$key]['paperwork'] = T_('irnic edu');
						break;

					case 'org.ir':
						$result[$key]['paperwork'] = T_('irnic private or edu');
						break;

					case 'ایران':
						// $result[$key]['paperwork'] = T_('unavailable');
						break;

					default:
						$result[$key]['paperwork'] = null;
						break;
				}
			}
			else
			{
				if(mb_substr($result[$key]['name'], -6) === '.ایران')
				{
					$result[$key]['tld'] = 'ایران';
					$result[$key]['name'] = mb_substr($result[$key]['name'], 0, -6);
				}
			}
		}

		return $result;
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
		$object_result = self::get_response_check($_domain);
		if(!$object_result)
		{
			return false;
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:chkData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:chkData') as $domainchkData)
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
		if(is_array($_domain))
		{
			$temp_string_xml = '<domain:name>JIBRES-SAMPLE-DOMAIN.IR</domain:name>';
			$string_xml = '';
			foreach ($_domain as $key => $one_domain)
			{
				$string_xml .= str_replace('JIBRES-SAMPLE-DOMAIN.IR', $one_domain, $temp_string_xml);
			}

			$xml = str_replace($temp_string_xml, $string_xml, $xml);

		}
		elseif(is_string($_domain))
		{
			$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);
		}

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