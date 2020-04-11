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


	private static function send_xml($_args)
	{
		$addr = root. 'lib/nic/exec/samples/domain_transfer.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);

		$xml = str_replace('JIBRES-PIN', $_args['pin'], $xml);

		$xml = str_replace('JIBRES-NIC-ACCOUNT', $_args['nic_id'], $xml);

		$response = \lib\nic\exec\run::send($xml, 'domain_transfer', 1, $_args['domain']);

		return $response;
	}
}
?>