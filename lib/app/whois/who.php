<?php
namespace lib\app\whois;



class who
{

	public static function is($_domain)
	{
		if(!\dash\validate::domain($_domain, false))
		{
			// \dash\notif::error(T_("This domain is not a valid domain"), 'domain');
			return false;
		}

		$result = [];

		$_domain = urldecode($_domain);

		// Creating default configured client
		$whois = \lib\nic\Iodev\Whois\Whois::create();


		$result['domain'] = $_domain;

		// Checking availability
		if ($whois->isDomainAvailable($_domain))
		{
			$result['available'] = true;
		}
		else
		{
			$result['available'] = false;

		}

		$response = $whois->lookupDomain($_domain);
		$result['answer'] = $response->getText();

		self::analyze_response($result);
		// var_dump($result);exit();

		return $result;

	}


	private static function analyze_response(&$result)
	{
		if(isset($result['answer']) && $result['answer'] && is_string($result['answer']))
		{
			$whois = $result['answer'];
		}
		else
		{
			return false;
		}

		// var_dump($whois);exit();

	}





	public static function is_old($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		$result = null;

		$domain = new \lib\nic\phpwhois\whois($_domain);
		if(\dash\engine\process::status())
		{
			$whois_answer                  = $domain->info();
			$result                        = [];
			$result['answer']              = $whois_answer;
			$result['php_whois_available'] = $domain->isAvailable();

		}

		$check_domain = \lib\app\nic_domain\check::check($_domain);
		if(isset($check_domain['available']) && $check_domain['available'])
		{
			$result['available'] = true;
		}
		else
		{
			$result['available'] = false;
		}


		return $result;

	}


}
?>