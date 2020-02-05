<?php
namespace content\whois;


class controller
{
	public static function routing()
	{
		if(\dash\url::subchild())
		{
			\dash\header::status(404);
		}

		\dash\open::get();
		\dash\open::post();

		$domain = \dash\url::child();
		if($domain)
		{
			if(\lib\app\nic_domain\check::syntax($domain))
			{
				\dash\data::myDomain($domain);
				$whois = \lib\app\nic_whois\who::is($domain);
				\dash\data::whoisResult($whois);
			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}
	}
}
?>