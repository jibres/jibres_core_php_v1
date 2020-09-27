<?php
namespace content_a\setting\domain\setting;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Domain setting'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


		$all_domain_name = \lib\app\business_domain\get::my_all_domains();
		\dash\data::domainList($all_domain_name);

		\dash\data::redirectAllDomainToMaster(\lib\store::detail('redirect_all_domain_to_master'));

	}
}
?>