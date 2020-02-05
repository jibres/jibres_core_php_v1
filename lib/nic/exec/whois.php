<?php
namespace lib\nic\exec;


class whois
{
	public static function run($_domain)
	{
		$addr = root. 'lib/nic/exec/samples/domain_info.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);
		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'whois',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);

		$tracking_number = 'TEST-JIBRES-WHOIS-'. $log_id;

		$xml = str_replace('JIBRES-TRACKING-NUMBER', $tracking_number, $xml);

		\lib\db\nic_log\update::send($xml, $log_id);


		$response = \lib\nic\exec\run::send($xml);
		j($response);


	}


}
?>