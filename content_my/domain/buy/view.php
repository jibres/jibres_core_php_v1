<?php
namespace content_my\domain\buy;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Buy domain"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		if(\dash\data::haveBuyDomain())
		{
			if(\lib\nic\mode::api())
			{
				$get_api = new \lib\nic\api();
				$list    = $get_api->contact_fetch_all();
				$dnslist = $get_api->dns_fetch_all();
			}
			else
			{
				$list    = \lib\app\nic_contact\search::my_list();
				$dnslist = \lib\app\nic_dns\search::my_list();
			}

			\dash\data::myContactList($list);
			\dash\data::myDNSList($dnslist);
		}

	}
}
?>