<?php
namespace content_love\domain\billing;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain billing"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];


		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_domainbilling\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


	}
}
?>
