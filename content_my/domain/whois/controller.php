<?php
namespace content_my\domain\whois;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();

		if(\dash\url::dir(4))
		{
			\dash\header::status(404);
		}

		\dash\open::get();
		\dash\open::post();

		$domain = \dash\url::subchild();
		if($domain)
		{
			\dash\data::myDomain(urldecode($domain));
			$whois = \lib\app\whois\who::is($domain);
			\dash\data::whoisResult($whois);
		}
	}
}
?>
