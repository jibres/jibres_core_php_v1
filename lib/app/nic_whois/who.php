<?php
namespace lib\app\nic_whois;


class who
{
	public static function is_quick($_domain)
	{
		$result = self::is($_domain);

		if(!is_array($result))
		{
			return false;
		}

		if(array_key_exists('available', $result))
		{
			return ['available' => $result['available']];
		}

		return false;
	}


	public static function is($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
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