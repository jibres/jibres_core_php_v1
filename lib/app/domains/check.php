<?php
namespace lib\app\domains;


class check
{
	public static function multi_check($_domain)
	{
		$domain = \dash\validate::string_200($_domain);
		$domain = \dash\validate::domain_clean($domain, false);

		if(!$domain)
		{
			\dash\notif::error(T_("Please enter a valid domain for check"));
			return false;
		}

		$tld = null;

		$real_domain = \dash\validate::domain($domain, false);
		$ir_domain   = \dash\validate::ir_domain($domain, false);

		if($ir_domain)
		{
			// user search jibres.ir
		}
		elseif($real_domain)
		{
			// user search jibres.com

			$explode = explode('.', $real_domain);
			$tld = end($explode);

		}
		else
		{
			// user search jibres

		}


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


		$domain = urldecode($domain);
		$domain = mb_strtolower($domain);

		$myDomainName = $domain;

		if(strpos($domain, '.') !== false)
		{
			$domain_tld = substr($domain, strpos($domain, '.'));
			$myDomainName = str_replace($domain_tld, '', $domain);
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
			'me',
			'io',
			'info',
			'app',
			'tv',
			// 'club',
			// 'dev',
		];

		// also check valid tld
		if($tld && !in_array($tld, $check_tld))
		{
			array_push($check_tld, $tld);
		}

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