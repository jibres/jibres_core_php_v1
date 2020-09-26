<?php
namespace content_a\setting\domain\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Add new domain'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

		// $myDomainList = \lib\app\business_domain\get::my_domain_not_connected_list();
		// \dash\data::myDomainList();


	}
}
?>