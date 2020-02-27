<?php
namespace content_management\store\analytics;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Stores"));
		\dash\data::page_desc(T_("View list of stores and add new one easily just in seconds."));


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\store\search::list_analytics($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\nic_domain\search::filter_message());

		$isFiltered = \lib\app\nic_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}
	}
}
?>
