<?php
namespace lib\nic\exec;


class domain
{
	public static function check($_domain)
	{
		$addr = root. 'lib/nic/exec/samples/domain_check.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);
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

		$tracking_number = 'TEST-JIBRES-DOMAIN-CHECK-'. $log_id;

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

		if(isset($response['xml']))
		{
			$update_after_send['response'] = addslashes($response['xml']);
		}

		if(isset($response['json']['response']['result']['@attributes']['code']))
		{
			$update_after_send['result_code'] = $response['json']['response']['result']['@attributes']['code'];
		}

		\lib\db\nic_log\update::update($update_after_send, $log_id);



	}


}
?>