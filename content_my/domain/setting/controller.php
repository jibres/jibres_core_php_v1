<?php
namespace content_my\domain\setting;


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
		if($domain)
		{
			if(\lib\app\nic_domain\check::syntax($domain))
			{
				$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);
				if(!$load_domain)
				{
					\dash\header::status(403);
				}
				\dash\data::myDomain($domain);
				\dash\data::domainDetail($load_domain);
			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}
		else
		{
			\dash\redirect::to(\dash\url::this());
		}


	}
}
?>