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
			if(\dash\validate::domain($domain))
			{
				if(\lib\nic\mode::api())
				{
					$get_api     = new \lib\nic\api();
					$load_domain = $get_api->domain_detail($domain);
				}
				else
				{
					$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);
				}

				if(!$load_domain)
				{
					\dash\header::status(403);
				}

				if(isset($load_domain['verify']) && $load_domain['verify'])
				{
					// no problem
				}
				else
				{
					if(in_array(\dash\url::subchild(), ['holder', 'dns', 'transfer']))
					{
						\dash\header::status(403, T_("Can not change this domain detail"));
					}
				}

				if(isset($load_domain['status']) && $load_domain['status'] === 'deleted')
				{
					\dash\header::status(404, T_("This domain is removed from your account"));
				}

				if(isset($load_domain['status']) && $load_domain['status'] === 'disable')
				{
					if(in_array(\dash\url::subchild(), ['holder', 'dns', 'transfer']))
					{
						\dash\header::status(403, T_("Can not change this domain detail"));
					}
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