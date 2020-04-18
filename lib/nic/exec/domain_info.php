<?php
namespace lib\nic\exec;


class domain_info
{

	public static function info($_domain)
	{
		$load_session = \dash\session::get('lastDomainFetched');
		var_dump($load_session);exit();
		if(isset($load_session[$_domain]) && isset($load_session['time']))
		{
			if(time() - $load_session['time'] < 60*2)
			{
				return $load_session[$_domain];
			}
		}

		$info = self::analyze_domain_info($_domain);
		if(!$info || !is_array($info))
		{
			return false;
		}

		$set_session = [$_domain => $info, 'time' => time()];
		\dash\session::set('lastDomainFetched', $set_session);

		return $info;
	}




	private static function analyze_domain_info($_domain)
	{

		$object_result = self::send_xml($_domain);

		if(!$object_result)
		{
			return false;
		}

		if(\lib\nic\exec\run::result_code($object_result) === '2303')
		{
			// error object not found and check domain is available so this domain is rejected
			$check_domain = \lib\nic\exec\domain_check::check($_domain);
			if(isset($check_domain['available']) && $check_domain['available'])
			{
				return ['status' => ['irnicRegistrationRejected'], 'force_disable' => true];
			}
		}

		$result = [];
		if(!isset($object_result->response->resData))
		{
			return false;
		}

		if(!$object_result->response->resData->xpath('domain:infData'))
		{
			return false;
		}

		foreach ($object_result->response->resData->xpath('domain:infData') as  $domaininfData)
		{
			$temp  = [];
			$myKey = null;

			foreach ($domaininfData->xpath('domain:name') as $domainname)
			{
				$myKey = $domainname->__toString();
				$temp[$myKey]['name']   = $myKey;
			}


			foreach ($domaininfData->xpath('domain:roid') as $domainroid)
			{
				$temp[$myKey]['roid']   = $domainroid->__toString();
			}


			foreach ($domaininfData->xpath('domain:crDate') as $domaincrDate)
			{
				$temp[$myKey]['crDate']   = $domaincrDate->__toString();
			}

			foreach ($domaininfData->xpath('domain:upDate') as $domainupDate)
			{
				$temp[$myKey]['upDate']   = $domainupDate->__toString();
			}

			foreach ($domaininfData->xpath('domain:exDate') as $domainexDate)
			{
				$temp[$myKey]['exDate']   = $domainexDate->__toString();
			}

			foreach ($domaininfData->xpath('domain:status') as $domainstatus)
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



			foreach ($domaininfData->xpath('domain:contact') as $domaincontact)
			{
				$attr             = $domaincontact->attributes();
				$attr             = (array) $attr;

				if(isset($attr['@attributes']))
				{
					$attr = $attr['@attributes'];
				}

				if(isset($attr['type']))
				{
					$temp[$myKey][$attr['type']] = $domaincontact->__toString();
				}
			}

			foreach ($domaininfData->xpath('domain:ns') as $domainns)
			{

				foreach ($domainns->xpath('domain:hostAttr') as $hostAttr)
				{
					foreach ($hostAttr->xpath('domain:hostName') as $hostName)
					{
						$temp[$myKey]['ns'][]   = $hostName->__toString();
					}

					foreach ($hostAttr->xpath('domain:hostAddr') as $hostAddr)
					{
						$temp[$myKey]['ip'][]   = $hostAddr->__toString();
					}
				}
			}

			$result = $temp;
		}

		return $result;
	}



	private static function send_xml($_domain)
	{
		$addr = root. 'lib/nic/exec/samples/domain_info.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-SAMPLE-DOMAIN.IR', $_domain, $xml);

		$response = \lib\nic\exec\run::send($xml, 'domain_info', 1, $_domain);

		return $response;
	}
}
?>