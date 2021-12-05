<?php
namespace content_my\domain\whois;


class controller
{
	public static function routing()
	{


		if(\dash\url::dir(4))
		{
			\dash\header::status(404);
		}

		\dash\open::get();
		\dash\open::post();

		$domain = \dash\url::subchild();
		if($domain)
		{
			\dash\data::myDomain(\dash\str::urldecode($domain));
			$whois = \lib\app\whois\who::is($domain);
			\dash\data::whoisResult($whois);
		}
		elseif(\dash\request::get('domain'))
		{
			$domain = \dash\request::get('domain');
			$whois = \lib\app\whois\who::is($domain);
			\dash\data::myDomain(\dash\str::urldecode($domain));
			\dash\data::whoisResult($whois);
		}
	}
}
?>
