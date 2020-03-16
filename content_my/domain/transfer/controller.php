<?php
namespace content_my\domain\transfer;


class controller
{
	public static function routing()
	{
		\content_my\domain\controller::check_login();

		$domain = \dash\request::get('q');
		$domain = urldecode($domain);
		if($domain)
		{
			if(\dash\validate::domain($domain))
			{
				$check = \lib\app\nic_domain\check::info($domain);
				if($check)
				{
					\dash\data::myDomain($domain);
					\dash\data::checkResult($check);
				}
			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}

	}
}
?>