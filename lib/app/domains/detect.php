<?php
namespace lib\app\domains;


class detect
{

	public static function whois($_domain)
	{
		return self::set($_domain, 'whois');
	}


	public static function set($_domain, $_type)
	{
		$detail = self::analyze_domain($_domain);
		if(!$detail)
		{
			return false;
		}

		$domain_id = self::id($detail);


		// `registrar` varchar(200) NULL DEFAULT NULL,
		// `datecreated` timestamp NULL DEFAULT NULL,
		// `dateregister` timestamp NULL DEFAULT NULL,
		// `dateexpire` timestamp NULL DEFAULT NULL,
		// `dateupdate` timestamp NULL DEFAULT NULL,
		// `ns1` varchar(200) NULL DEFAULT NULL,
		// `ns2` varchar(200) NULL DEFAULT NULL,
		// `ns3` varchar(200) NULL DEFAULT NULL,
		// `ns4` varchar(200) NULL DEFAULT NULL,


		$insert_domainactivity =
		[
			'domain_id'   => $domain_id,
			'user_id'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s"),
			'type'        => $_type,
			'ip'          => \dash\server::ip(),
			'result'      => null,
			// 'runtime'     => \dash\runtime::json(),
		];

		\lib\db\domains\insert::new_record_activity($insert_domainactivity);
	}


	private static function analyze_domain($_domain)
	{
		$domain = \dash\validate::string_200($_domain, false);
		if(!$domain)
		{
			return false;
		}

		$subdomain = null;
		$root      = null;
		$tld       = null;

		$domain = explode('.', $domain);
		// remove empty character for example reza.
		$domain = array_filter($domain);

		if(count($domain) >= 4)
		{
			$subdomain = $domain[0];

			array_shift($domain);
			reset($domain);

			$root      = $domain[0];

			array_shift($domain);
			reset($domain);

			$tld       = implode('.', $domain);
		}
		elseif(count($domain) === 3)
		{
			$subdomain = $domain[0];
			$root      = $domain[1];
			$tld       = $domain[2];
		}
		elseif(count($domain) === 2)
		{
			$root      = $domain[0];
			$tld       = $domain[1];
		}
		else
		{
			return false;
		}

		// 'id.ir','gov.ir','co.ir','net.ir','org.ir','sch.ir','ac.ir',
		if($tld === 'ir' && in_array($root, ['id', 'gov', 'co', 'net', 'org', 'sch', 'ac']))
		{
			$tld       = $root. '.'. $tld;
			$root      = $subdomain;
			$subdomain = null;
		}

		$result =
		[
			'subdomain' => $subdomain,
			'root'      => $root,
			'tld'       => $tld,
			'domain'    => $_domain,
			'domainlen' => mb_strlen($root),
		];

		return $result;

	}


	private static function id($_detail)
	{
		$check_exists = \lib\db\domains\get::check_exists($_detail['domain']);

		if(isset($check_exists['id']))
		{
			return $check_exists['id'];
		}
		else
		{
			$insert_id = \lib\db\domains\insert::new_record($_detail);
			return $insert_id;
		}
	}
}
?>