<?php
namespace content_domain\buy;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Jibres Domans"));

		\dash\data::page_special(true);

		$list = \lib\app\nic_contact\search::my_list();
		\dash\data::myContactList($list);

		$list = \lib\app\nic_dns\search::my_list();

		\dash\data::myDNSList($list);
	}
}
?>