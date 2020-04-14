<?php
namespace lib\app\nic_domain;


class check
{
	public static function multi_check($_domain)
	{
		$check_tld =
		[
			// person
			'ir',
			// 'ایران', // Not enable!
			'id.ir',
			// gov
			'gov.ir',
			'co.ir',
			'net.ir',
			'org.ir',
			// edu
			'sch.ir',
			'ac.ir',
		];

		$_domain = \dash\validate::string_200($_domain);

		if(!$_domain)
		{
			\dash\notif::error(T_("Please enter a valid domain for check"));
			return false;
		}

		$_domain = urldecode($_domain);
		$_domain = mb_strtolower($_domain);

		$myDomainName = $_domain;

		if(strpos($_domain, '.') !== false)
		{
			$domain_tld = substr($_domain, strpos($_domain, '.'));
			$myDomainName = str_replace($domain_tld, '', $_domain);
		}

		$domains = [];
		foreach ($check_tld as $tld)
		{
			$domains[] = $myDomainName. '.'. $tld;
		}

		$result = \lib\nic\exec\domain_check::multi_check($domains);

		\lib\app\domains\detect::domain_check_multi($result);

		// $check_tld =
		// [
		// 	'com',
		// 	'net',
		// 	'org',
		// ];

		// foreach ($check_tld as  $tld)
		// {
		// 	$temp_domain = $myDomainName. '.'. $tld;
		// 	$check_result = \lib\app\nic_whois\who::is_quick($temp_domain);
		// 	$check_result['soon'] = true;
		// 	$check_result['name'] = $temp_domain;
		// 	$check_result['tld'] = $tld;
		// 	$result[$temp_domain] = $check_result;
		// }

		return $result;
	}

	public static function check($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		\lib\app\domains\detect::domain('check', $_domain, $result);

		return $result;

	}


	public static function info($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}


		$result = \lib\nic\exec\domain_info::info($_domain);

		\lib\app\domains\detect::domain_info($_domain, $result);

		if(!isset($result[$_domain]))
		{
			\dash\notif::error(T_("Domain not found"));
			return false;
		}
		return $result[$_domain];

	}
}
?>