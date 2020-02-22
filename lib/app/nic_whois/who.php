<?php
namespace lib\app\nic_whois;


class who
{
	public static function is($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		// @javad run this code to run nic curl
		// $result = \lib\nic\exec\whois::run($_domain);
		$result = null;

		$domain = new \lib\nic\phpwhois\whois($_domain);
		if(\dash\engine\process::status())
		{
			$whois_answer = $domain->info();
			$result = [];
			$result['answer'] = $whois_answer;
			$result['available'] = $domain->isAvailable();

		}

		return $result;

	}
}
?>