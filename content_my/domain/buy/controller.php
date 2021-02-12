<?php
namespace content_my\domain\buy;


class controller
{
	public static function routing()
	{


		if(\dash\url::dir(3))
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		$domain = \dash\url::subchild();
		$domain = urldecode($domain);
		$domain = mb_strtolower($domain);

		$q = \dash\request::get('q');
		$q = \dash\validate::string($q, false);

		\dash\data::getDomain($q);


		if($domain)
		{
			\dash\open::get();
			\dash\open::post();

			\dash\data::myDomain($domain);

			$domain = \dash\validate::domain($domain, false);

			if($domain)
			{
				$check = \lib\app\domains\check::check($domain);
				\dash\data::haveBuyDomain(true);
				\dash\data::checkResult($check);
			}
			else
			{
				\dash\data::domainError(T_("Invalid error syntax"));
			}
		}
		elseif($q)
		{

			$info = \lib\app\domains\check::multi_check($q);

			if(\dash\request::get('q') && !$info && \dash\engine\process::status())
			{
				\dash\data::InvalidDomain(true);
			}


			\dash\data::infoResult($info);
		}

	}
}
?>