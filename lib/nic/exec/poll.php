<?php
namespace lib\nic\exec;


class poll
{

	public static function request()
	{
		return;
		$pull = self::analyze_poll_request();
		j($pull);

	}




	private static function analyze_poll_request()
	{

		// $object_result = self::get_poll_request();
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0" xmlns:domain="http://epp.nic.ir/ns/domain-1.0">
  <response xmlns:domain="http://epp.nic.ir/ns/domain-1.0">
  <result code="1301">
  <msg>Command completed successfully; ack to dequeue</msg>
  </result>
  <msgQ count="14" id="25300">
  <qDate>2020-02-09T16:30:01</qDate>
  <msg>
  <index xmlns="">DomainUpdateStatus</index>
  <note xmlns=""/>
</msg>
  </msgQ>
  <resData xmlns:domain="http://epp.nic.ir/ns/domain-1.0">
  <domain:polData xmlns:domain="http://epp.nic.ir/ns/domain-1.0">
  <domain:name>reza.ir</domain:name>
  <domain:roid>308692</domain:roid>
  <domain:status s="serverHold"/>
  <domain:status s="irnicReserved"/>
  <domain:status s="serverRenewProhibited"/>
  <domain:status s="serverDeleteProhibited"/>
  <domain:status s="irnicRegistrationApproved"/>
</domain:polData>
  </resData>
  <trID>
  <clTRID>TEST-LOCAL-JIBRES-2020-02-14-18:47:57-POLL-1210</clTRID>
  <svTRID>IRNIC_2020-02-14T18:47:59+03:30_cg9</svTRID>
  </trID>
  </response>
</epp>';

		$object_result = new \SimpleXMLElement($xml);

		if(!$object_result)
		{
			return false;
		}

		$result = [];

		if(!isset($object_result->response->msgQ))
		{
			return false;
		}
		if(isset($object_result->response->msgQ['@attributes']))
		{

		}

		foreach ($object_result->response->msgQ->xpath('domain:polData') as  $domainpolData)
		{
		}

		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:polData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:polData') as  $domainpolData)
		{
			$temp  = [];
			$myKey = null;

			foreach ($domainpolData->xpath('domain:name') as $domainname)
			{
				$myKey = $domainname->__toString();
				$temp[$myKey]['id']   = $myKey;
			}


			foreach ($domainpolData->xpath('domain:roid') as $domainroid)
			{
				$temp[$myKey]['roid']   = $domainroid->__toString();
			}

			foreach ($domainpolData->xpath('domain:status') as $domainstatus)
			{
				$attr             = $domainstatus->attributes();
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

			$result = $temp;
		}

		return $result;
	}



	private static function get_poll_request()
	{
		$addr = root. 'lib/nic/exec/samples/poll_req.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$insert_log =
		[
			'type'          => 'contact_info',
			'user_id'       => \dash\user::id(),
			'send'          => null,
			'datesend'      => date("Y-m-d H:i:s"),
			'request_count' => 1,
		];

		$log_id = \lib\db\nic_log\insert::new_record($insert_log);

		$tracking_number = \lib\nic\exec\run::make_tracking_number($log_id, get_class());

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

		if(isset($response))
		{
			$update_after_send['response'] = addslashes($response);
		}

		$object = new \SimpleXMLElement($response);

		$update_after_send['result_code'] = \lib\nic\exec\run::result_code($object);
		$update_after_send['server_id'] = \lib\nic\exec\run::server_id($object);


		\lib\db\nic_log\update::update($update_after_send, $log_id);

		return $object;

	}


}
?>