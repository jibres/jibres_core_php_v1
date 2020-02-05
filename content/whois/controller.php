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

		$domain = \dash\url::child();
		if($domain)
		{
			if(\lib\nic\app\domain\check::syntax($domain))
			{
				\dash\data::myDomain($domain);
				$whois = \lib\nic\app\whois\who::is($domain);

			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}
		\dash\open::get();
	}
}
?>