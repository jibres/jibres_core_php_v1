<?php
namespace content_my\domain\other;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();

		// if(\dash\url::child())
		// {
		// 	\dash\header::status(404, T_("Invalid url"));
		// }

		// \dash\open::get();
		// \dash\open::post();

		// $domain = \dash\url::module();
		// if($domain)
		// {
		// 	if(\dash\validate::domain($domain))
		// 	{
		// 		\dash\data::myDomain($domain);
		// 		$check = \lib\app\nic_domain\check::check($domain);
		// 		\dash\data::checkResult($check);
		// 	}
		// 	else
		// 	{
		// 		\dash\data::domainError(T_("Invalid error syntax"));
		// 	}
		// }
	}
}
?>