<?php
namespace lib\api\nic\exec;


class contact_check
{
	private static $detail      = [];
	private static $detail_info = [];

	public static function check($_contact)
	{
		if(isset(self::$detail[$_contact]))
		{
			return self::$detail[$_contact];
		}

		$check = self::analyze_contact_check($_contact);
		if(!$check || !is_array($check))
		{
			return false;
		}

		self::$detail[$_contact] = $check;

		return $check;
	}


	private static function analyze_contact_check($_contact)
	{

		$object_result = self::send_xml($_contact);

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





	private static function send_xml($_contact)
	{
		$addr = root. 'lib/api/nic/exec/samples/contact_check.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-CHECK', $_contact, $xml);

		$response = \lib\api\nic\exec\run::send($xml, 'contact_check', 1, null, $_contact);

		$result_code = \lib\api\nic\exec\run::result_code($response);

		return $response;

	}



	public static function info($_contact)
	{
		if(isset(self::$detail_info[$_contact]))
		{
			return self::$detail_info[$_contact];
		}

		$info = self::analyze_contact_info($_contact);

		if(!$info || !is_array($info))
		{
			return false;
		}

		self::$detail_info[$_contact] = $info;

		return $info;
	}



	private static function analyze_contact_info($_contact)
	{

		$object_result = self::send_xml_info($_contact);

		if(!$object_result)
		{
			return false;
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('contact:infData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('contact:infData') as  $contactInfoData)
		{

			$temp  = [];

			foreach ($contactInfoData->xpath('contact:id') as $value)
			{
				$temp['id']   = $value->__toString();
			}

			foreach ($contactInfoData->xpath('contact:email') as $value)
			{
				$temp['email']   = $value->__toString();
			}

			foreach ($contactInfoData->xpath('contact:roid') as $value)
			{
				$temp['roid']   = $value->__toString();
			}

			$result = $temp;
		}

		return $result;
	}





	private static function send_xml_info($_contact)
	{
		$addr = root. 'lib/api/nic/exec/samples/contact_info.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-INFO', $_contact, $xml);

		$response = \lib\api\nic\exec\run::send($xml, 'contact_info', 1, null, $_contact);

		$result_code = \lib\api\nic\exec\run::result_code($response);

		return $response;

	}
}
?>