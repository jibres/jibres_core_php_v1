<?php
namespace lib\api\nic\exec;


class domain_transfer
{


	public static function transfer($_args)
	{
		$transfer = self::analyze_domain_transfer($_args);

		return $transfer;
	}




	private static function analyze_domain_transfer($_args)
	{

		$object_result = self::send_xml($_args);

		if(!$object_result)
		{
			return false;
		}

		if(\lib\api\nic\exec\run::result_code($object_result) === '1000')
		{
			return true;
		}
		else
		{
			return false;
		}

	}


	private static function send_xml($_args)
	{
		$addr = root. 'lib/api/nic/exec/samples/domain_transfer.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);

		$xml = str_replace('JIBRES-PIN', $_args['pin'], $xml);

		$xml = str_replace('JIBRES-NIC-ACCOUNT', $_args['nic_id'], $xml);

		$response = \lib\api\nic\exec\run::send($xml, 'domain_transfer', 1, $_args['domain']);

		return $response;
	}
}
?>