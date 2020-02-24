<?php
namespace content_my\domain\buy;


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
			if(\lib\app\nic_domain\check::syntax($domain))
			{
				\dash\data::myDomain($domain);
				$check = \lib\app\nic_domain\check::check($domain);
				\dash\data::checkResult($check);
			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}
		else
		{
			$q = \dash\request::get('q');

			$info = \lib\app\nic_domain\check::multi_check($q);

			\dash\data::infoResult($info);
		}

	}
}
?>