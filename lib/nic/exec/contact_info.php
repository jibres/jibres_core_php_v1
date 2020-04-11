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




	private static function analyze_contact_info($_args)
	{

		$object_result = self::send_xml($_args);

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

		foreach ($object_result->response->resData->xpath('contact:infData') as  $contactinfData)
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



	private static function send_xml($_contact)
	{
		$addr = root. 'lib/nic/exec/samples/contact_info.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-INFO', $_contact, $xml);

		$response = \lib\nic\exec\run::send($xml, 'contact_info', 1, null, $_contact);

		return $response;
	}
}
?>