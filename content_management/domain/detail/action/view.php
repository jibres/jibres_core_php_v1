<?php
namespace content_management\domain\detail\action;


class view
{
	public static function config()
	{
		\dash\data::page_title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'domain_id' => \dash\data::domainDetail_id(),
		];
		$list = \lib\app\nic_domainaction\search::list(null, $args);

		\dash\data::dataTable($list);
	}
}
?>