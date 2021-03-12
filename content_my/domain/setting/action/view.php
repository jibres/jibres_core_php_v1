<?php
namespace content_my\domain\setting\action;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain action"));

				// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?domain='. \dash\request::get('domain'));

		$args =
		[
			'domain_id' => \dash\data::domainDetail_id(),
		];

		$list = \lib\app\nic_domainaction\search::domain_list(null, $args);

		\dash\data::dataTable($list);
	}
}
?>