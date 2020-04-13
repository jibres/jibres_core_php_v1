<?php
namespace content_my\domain\history;


class view
{
	public static function config()
	{
		\dash\face::title(T_("IRNIC Notification"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());


		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$list = $get_api->domain_history();
		}
		else
		{
			$list = \lib\app\nic_domainaction\search::all_list(null, []);
		}

		\dash\data::dataTable($list);

	}
}
?>