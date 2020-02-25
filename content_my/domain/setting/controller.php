<?php
namespace content_my\domain\setting;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();

		$domain = \dash\request::get('domain');
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