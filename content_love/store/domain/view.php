<?php
namespace content_love\store\domain;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Store domains"));

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\store\search::list_domain($search_string, $args);

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
