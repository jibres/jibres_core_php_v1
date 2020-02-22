<?php
namespace lib\app\nic_domain;


class check
{
	public static function syntax($_domain)
	{
		if(!$_domain || !is_string($_domain))
		{
			// \dash\notif::error(T_("Please fill domain"), 'domain');
			return false;
		}

		if(strpos($_domain, '.') === false)
		{
			return false;
		}
		else
		{
			if(!preg_match("/^[\w\d]+\.(ir)$/", $_domain))
			{
				// return false;
			}
		}

		return true;

	}


	public static function multi_check($_domain)
	{
		$check_tld =
		[
			'ir',
			'id.ir',
			'co.ir',
			'ac.ir',
			'org.ir',
			'net.ir',
			'sch.ir',
			'gov.ir',
			'ایران',
		];

		if(!$_domain || !is_string($_domain))
		{
			return false;
		}

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


		$check_tld =
		[
			'com',
			'net',
			'org',
		];

		foreach ($check_tld as  $tld)
		{
			$temp_domain = $myDomainName. '.'. $tld;
			$check_result = \lib\app\nic_whois\who::is_quick($temp_domain);
			$check_result['soon'] = true;
			$check_result['name'] = $temp_domain;
			$check_result['tld'] = $tld;
			$result[$temp_domain] = $check_result;
		}

		return $result;
	}

	public static function check($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		return $result;

	}


	public static function variable()
	{
		$autorenew = \dash\app::request('autorenew') ? 1 : null;


		$args              = [];
		$args['autorenew'] = $autorenew;
		return $args;
	}
}
?>