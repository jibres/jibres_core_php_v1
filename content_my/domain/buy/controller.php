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

		$q      = \dash\request::get('q');

		if($domain)
		{
			\dash\open::get();
			\dash\open::post();

			\dash\data::myDomain($domain);

			if(\dash\validate::domain($domain, false))
			{
				if(\lib\nic\mode::api())
				{
					$get_api = new \lib\nic\api();
					$check    = $get_api->domain_available($domain);
				}
				else
				{
					$check = \lib\app\nic_domain\check::check($domain);
				}

				\dash\data::checkResult($check);
			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}
		elseif($q)
		{

			if(\lib\nic\mode::api())
			{
				$get_api = new \lib\nic\api();
				$info    = $get_api->domain_check($q);
			}
			else
			{
				$info = \lib\app\nic_domain\check::multi_check($q);
			}


			\dash\data::infoResult($info);
		}

	}
}
?>