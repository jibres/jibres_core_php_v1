<?php
namespace content_domain\home;


class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		\dash\open::get();
		\dash\open::post();

		$domain = \dash\url::module();
		if($domain)
		{
			if(\lib\app\nic_domain\check::syntax($domain))
			{
				\dash\data::myDomain($domain);
				$whois = \lib\app\nic_domain\check::check($domain);
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