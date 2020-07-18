<?php
namespace content_a\setting\domain;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Domain'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/website');


		$domain_list = \lib\app\store\domain::get_domain_list();
		\dash\data::domainList($domain_list);


		\dash\data::global_scriptPage('a_connect_domain.js');

		$businessRemoveDomain = \dash\session::get('businessRemoveDomain');
		$businessNewDomain    = \dash\session::get('businessNewDomain');

		if($businessRemoveDomain)
		{
			\dash\data::myWorkDomainType('remove');
			\dash\data::myWorkDomain($businessRemoveDomain);
		}

		if($businessNewDomain)
		{
			\dash\data::myWorkDomainType('add');
			\dash\data::myWorkDomain($businessNewDomain);
		}

	}
}
?>