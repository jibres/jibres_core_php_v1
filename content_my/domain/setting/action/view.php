<?php
namespace content_my\domain\setting\action;


class view
{
	public static function config()
	{
		\dash\face::title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());


		if(\lib\nic\mode::api())
		{
			$get_api     = new \lib\nic\api();
			$list = $get_api->domain_action(\dash\data::domainDetail_id());
		}
		else
		{

			$args =
			[
				'domain_id' => \dash\data::domainDetail_id(),
			];

			$list = \lib\app\nic_domainaction\search::domain_list(null, $args);
		}

		\dash\data::dataTable($list);
	}
}
?>