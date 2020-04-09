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
			\dash\data::myDomain(urldecode($domain));
			$whois = \lib\app\whois\who::is($domain);
			\dash\data::whoisResult($whois);
		}
	}
}
?>