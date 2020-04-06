<?php
namespace lib\nic\exec;


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
		$addr = root. 'lib/nic/exec/samples/domain_transfer_lock.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);

		$response = \lib\nic\exec\run::send($xml, 'domain_lock');

		if(\lib\nic\exec\run::result_code($response) != '1000')
		{
			return false;
		}

		return $response;
	}






	private static function send_xml_unlock($_domain)
	{
		$addr = root. 'lib/nic/exec/samples/domain_transfer_req.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);

		$response = \lib\nic\exec\run::send($xml, 'domain_unlock');

		if(\lib\nic\exec\run::result_code($response) != '1000')
		{
			return false;
		}

		return $response;
	}
}
?>