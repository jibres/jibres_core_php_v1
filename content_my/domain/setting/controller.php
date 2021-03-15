<?php
namespace content_my\domain\setting;


class controller
{
	public static function routing()
	{


		$domain = \dash\request::get('domain');
		if($domain)
		{
			if(\dash\validate::domain($domain))
			{
				if(!\dash\validate::ir_domain($domain, false))
				{
					\dash\data::internationalDomain(true);
				}

				$load_domain = \lib\app\nic_domain\get::is_my_domain($domain);

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

				if(isset($load_domain['temp_period']) && $load_domain['temp_period'])
				{
					$domain_id = \dash\coding::decode(\dash\data::domainDetail_id());
					if($domain_id)
					{
						$register_action = \lib\app\nic_domainaction\get::last_record_domain_id_caller($domain_id, 'register');
						if(isset($register_action['period']) && $register_action['period'])
						{
							\dash\data::tempPeriod($register_action['period_title']);
						}
					}

				}
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