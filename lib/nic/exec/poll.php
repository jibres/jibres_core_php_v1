<?php
namespace lib\nic\exec;


class poll
{

	public static function request()
	{
		$poll = self::analyze_poll_request();
		return $poll;
	}


	public static function acknowledge($_id)
	{
		$result = self::send_xml_acknowledge($_id);
		return $result;
	}

	private static function send_xml_acknowledge($_id)
	{
		$addr = root. 'lib/nic/exec/samples/poll_ack.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-POLL-ID', $_id, $xml);

		$response = \lib\nic\exec\run::send($xml, 'poll_acknowledge');

		return $response;
	}



	private static function analyze_poll_request()
	{
		$object_result = self::send_xml_poll_request();

		if(!$object_result)
		{
			return false;
		}

		// no new poll
		if(\lib\nic\exec\run::result_code($object_result) !== '1301')
		{
			return null;
		}

		$result = [];

		if(!isset($object_result->response->msgQ))
		{
			return false;
		}

		$attr             = $object_result->response->msgQ->attributes();
		$attr             = (array) $attr;

		if(isset($attr['@attributes']))
		{
			$attr = $attr['@attributes'];
		}

		if(isset($attr['count']))
		{
			$result['count']   = $attr['count'];
		}

		if(isset($attr['id']))
		{
			$result['id']   = $attr['id'];
		}

		if(isset($object_result->response->msgQ->msg))
		{
			foreach ($object_result->response->msgQ->msg as  $msg)
			{
				foreach ($msg->xpath('index') as $index)
				{
					$result['index'] = $index->__toString();
				}

				foreach ($msg->xpath('note') as $note)
				{
					$result['note'] = $note->__toString();
				}
			}
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
				$result['domain'] = $myKey;
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

			$result['detail'] = $temp;
		}

		return $result;
	}



	private static function send_xml_poll_request()
	{
		$addr = root. 'lib/nic/exec/samples/poll_req.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-TOKEN', \lib\nic\exec\run::token(), $xml);

		$response = \lib\nic\exec\run::send($xml, 'poll_request');

		return $response;
	}
}
?>