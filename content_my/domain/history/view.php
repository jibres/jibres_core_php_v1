<?php
namespace content_my\domain\history;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain activity"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$list = \lib\app\nic_domainaction\search::all_list(null, []);

		\dash\data::dataTable($list);

	}
}
?>