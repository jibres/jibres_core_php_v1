<?php
namespace content_love\domain\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('Log'));
		\dash\data::action_link(\dash\url::this(). '/log');


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		\dash\temp::set('disableDomainFetch', true);

		$search_string = \dash\validate::search_string();

		$list = \lib\app\nic_domain\search::list_admin($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\nic_domain\search::filter_message());

		$isFiltered = \lib\app\nic_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		$dashboard_detail = \lib\app\nic_domain\dashboard::admin();

		\dash\data::dashboardDetail($dashboard_detail);
	}
}
?>
