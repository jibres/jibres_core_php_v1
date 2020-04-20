<?php
namespace content_my\domain\payments;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Payments"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'lastyear' => \dash\request::get('time') === '365' ? true : null,
		];

		if(\lib\nic\mode::api())
		{
			$get_api = new \lib\nic\api();
			$list = $get_api->domain_history();
		}
		else
		{
			$list = \lib\app\nic_domainbilling\search::my_list(null, $args);
		}

		\dash\data::dataTable($list);

	}
}
?>