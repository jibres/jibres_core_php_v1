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
		$addr = root. 'lib/nic/exec/samples/contact_check.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-CHECK', $_contact, $xml);

		$response = \lib\nic\exec\run::send($xml, 'contact_check');

		$result_code = \lib\nic\exec\run::result_code($response);

		return $response;

	}
}
?>