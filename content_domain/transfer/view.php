<?php
namespace content_domain\transfer;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Transfer domain"));

		// btn
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::here());

		\dash\data::page_special(true);

		$list = \lib\app\nic_contact\search::my_list();
		\dash\data::myContactList($list);

		$list = \lib\app\nic_dns\search::my_list();

		\dash\data::myDNSList($list);
	}
}
?>