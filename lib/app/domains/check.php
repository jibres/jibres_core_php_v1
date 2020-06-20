<?php
namespace lib\app\domains;


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

		$check_nic_domain = \lib\nic\exec\domain_check::multi_check($domains);



		$check_tld =
		[
			'com',
			'net',
			'org',
			'xyz',
		];

		$international_domain = [];
		foreach ($check_tld as  $tld)
		{
			$international_domain[] = $myDomainName. '.'. $tld;
		}

		$check_namecheap_domain = \lib\namecheap\api::check_domain($international_domain);

		if(!is_array($check_namecheap_domain))
		{
			$check_namecheap_domain = [];
		}

		if(!is_array($check_nic_domain))
		{
			$check_nic_domain = [];

		}
		$result = array_merge($check_namecheap_domain, $check_nic_domain);


		\lib\app\domains\detect::domain_check_multi($result);

		return $result;
	}


	public static function check($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		if(\dash\validate::ir_domain($_domain, false))
		{
			return \lib\app\nic_domain\check::check($_domain);
		}
		else
		{
			return \lib\app\onlinenic\check::check($_domain, 'register');
		}
	}


}
?>