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



		$domain = \dash\url::subchild();
		$domain = urldecode($domain);
		$domain = mb_strtolower($domain);
		if($domain)
		{
			\dash\open::get();
			\dash\open::post();

			\dash\data::myDomain($domain);

			if(\lib\app\nic_domain\check::syntax($domain))
			{
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
			$q = urldecode($q);
			$q = mb_strtolower($q);

			$info = \lib\app\nic_domain\check::multi_check($q);

			\dash\data::infoResult($info);
		}

	}
}
?>