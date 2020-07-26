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
			// user search one string. for example 'jibres' not jibres.ir or jibres.cloud or ...
		}

		$check_tld =
		[
			// person
			'ir',
			// 'ایران', // Not enable!
			'id.ir',
			'co.ir',
			'ac.ir',
			'sch.ir',
			'net.ir',
			'org.ir',
			'gov.ir',
		];


		$domain = urldecode($domain);
		$domain = mb_strtolower($domain);

		$myDomainName = $domain;

		if(strpos($domain, '.') !== false)
		{
			$domain_tld = substr($domain, strpos($domain, '.'));
			$myDomainName = str_replace($domain_tld, '', $domain);
		}

		$ir_domains = [];
		foreach ($check_tld as $myTld)
		{
			$ir_domains[] = $myDomainName. '.'. $myTld;
		}



		$check_nic_domain = \lib\nic\exec\domain_check::multi_check($ir_domains);


		$check_tld_international =
		[
			'com',
			'net',
			'org',
			'xyz',
			'me',
			'io',
			'info',
			'app',
			// 'tv',
			// 'club',
			// 'dev',
		];

		if($tld && !in_array($tld, $check_tld_international))
		{
			array_unshift($check_tld_international, $tld);
			unset($check_tld_international[array_search('app', $check_tld_international)]);
		}


		$international_domains = [];
		foreach ($check_tld_international as  $myTld)
		{
			$international_domains[] = $myDomainName. '.'. $myTld;
		}

		$check_namecheap_domain = \lib\namecheap\api::check_domain($international_domains);


		if(!is_array($check_namecheap_domain))
		{
			$check_namecheap_domain = [];
		}

		if(!is_array($check_nic_domain))
		{
			$check_nic_domain = [];
		}

		$result['ir_list'] = $check_nic_domain;
		$result['com_list'] = $check_namecheap_domain;



		\lib\app\domains\detect::domain_check_multi($result);

		// var_dump($result);exit();
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