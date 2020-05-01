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
			'order'    => \dash\request::get('order'),
			'sort'     => \dash\request::get('sort'),
			'action'   => \dash\request::get('action'),
			'user'   => \dash\request::get('user'),
			'is_admin' => true,
		];


		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_domainbilling\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		$group_by_action = \lib\app\nic_domainbilling\get::group_by_action();
		\dash\data::groupByAction($group_by_action);


		$price_group = \lib\app\nic_domainbilling\get::price_group();
		\dash\data::groupByPrice($price_group);


	}
}
?>
