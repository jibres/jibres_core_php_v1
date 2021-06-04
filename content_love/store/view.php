<?php
namespace content_love\store;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Stores"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'user'   => \dash\request::get('user'),

		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\store\search::list_admin($search_string, $args);

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

	}
}
?>
