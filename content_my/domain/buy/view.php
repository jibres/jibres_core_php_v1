<?php
namespace content_my\domain\buy;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Buy domain"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::page_special(true);

		$list = \lib\app\nic_contact\search::my_list();
		\dash\data::myContactList($list);

		$list = \lib\app\nic_dns\search::my_list();

		\dash\data::myDNSList($list);
	}
}
?>