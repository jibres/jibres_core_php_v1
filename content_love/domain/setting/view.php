<?php
namespace content_love\domain\setting;


class view
{
	public static function config()
	{
		\dash\face::title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this(). '/all');

		$args =
		[
			'domain' => \dash\data::domainDetail_name(),
		];
		$load_status = \lib\app\nic_domainstatus\search::list(null, $args);

		\dash\data::NICdomainStatus($load_status);

	}
}
?>