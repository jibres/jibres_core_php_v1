<?php
namespace lib\api\nic\exec;


class domain_lock
{


	public static function lock($_domain)
	{

		$object_result = self::send_xml_lock($_domain);

		if(!$object_result)
		{
			return false;
		}

		return true;

	}


	public static function unlock($_domain)
	{
		$object_result = self::send_xml_unlock($_domain);

		if(!$object_result)
		{
			return false;
		}

		return true;
	}





	private static function send_xml_lock($_domain)
	{
		$addr = root. 'lib/api/nic/exec/samples/domain_transfer_lock.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);

		$response = \lib\api\nic\exec\run::send($xml, 'domain_lock', 1, $_domain);

		if(\lib\api\nic\exec\run::result_code($response) != '1000')
		{
			return false;
		}

		return $response;
	}






	private static function send_xml_unlock($_domain)
	{
		$addr = root. 'lib/api/nic/exec/samples/domain_transfer_req.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);

		$response = \lib\api\nic\exec\run::send($xml, 'domain_unlock', 1, $_domain);

		if(\lib\api\nic\exec\run::result_code($response) != '1000')
		{
			return false;
		}

		return $response;
	}
}
?>