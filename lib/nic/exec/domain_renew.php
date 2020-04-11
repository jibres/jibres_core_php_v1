<?php
namespace lib\nic\exec;


class domain_renew
{


	public static function renew($_args)
	{
		$renew = self::analyze_domain_renew($_args);

		return $renew;
	}




	private static function analyze_domain_renew($_args)
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

		if(\lib\nic\exec\run::result_code($object_result) === '1001')
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
		$addr = root. 'lib/nic/exec/samples/domain_renew.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_args['domain'], $xml);


		$xml = str_replace('PERIOD', $_args['period'], $xml);
		$xml = str_replace('JIBRES-CURRENT-EXPIRE-DATE', $_args['current_expiredate'], $xml);

		$response = \lib\nic\exec\run::send($xml, 'domain_renew', 1, $_args['domain']);

		return $response;
	}
}
?>