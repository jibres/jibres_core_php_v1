<?php
namespace content_my\domain\payments;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Payments"));

		// btn
		\dash\data::back_text(T_('Domain Center'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'lastyear' => \dash\request::get('time') === '365' ? true : null,
		];

		$list = \lib\app\nic_domainbilling\search::my_list(null, $args);

		\dash\data::dataTable($list);

	}
}
?>