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

		$domain = \dash\request::get('domain');
		$domain = urldecode($domain);
		if($domain)
		{
			if(\dash\validate::domain($domain))
			{
				if(!\dash\validate::ir_domain($domain, false))
				{
					\dash\data::internationalDomain(true);
				}

				\dash\data::myDomain($domain);
			}
		}

	}
}
?>