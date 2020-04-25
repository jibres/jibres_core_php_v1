<?php
namespace content_love\domain\buyers;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain buyers"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order'    => \dash\request::get('order'),
			'sort'     => \dash\request::get('sort'),
			'is_admin' => true,
		];


		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_domainbilling\search::buyers($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


	}
}
?>
