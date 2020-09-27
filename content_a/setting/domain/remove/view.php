<?php
namespace content_a\setting\domain\remove;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. \dash\data::domainDetail_domain());

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		$dnsList = \lib\app\business_domain\dns::list(\dash\data::domainID());
		\dash\data::dnsList($dnsList);

		$master_domain = \lib\app\business_domain\get::my_business_master_domain();
		\dash\data::masterDomain($master_domain);

		$all_domain_name = \lib\app\business_domain\get::my_all_domains();
		\dash\data::domainList($all_domain_name);
	}
}
?>