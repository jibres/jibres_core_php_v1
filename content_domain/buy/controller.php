<?php
namespace content_domain\buy;


class controller
{
	public static function routing()
	{
		if(\dash\url::subchild())
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		\dash\open::get();
		\dash\open::post();

		$domain = \dash\url::child();
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
	}
}
?>