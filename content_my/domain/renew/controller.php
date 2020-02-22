<?php
namespace content_my\domain\renew;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();

		if(\dash\url::dir(3))
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		\dash\open::get();
		\dash\open::post();

		$domain = \dash\url::subchild();
		$domain = urldecode($domain);
		if($domain)
		{
			\dash\data::myDomain($domain);
		}
	}
}
?>