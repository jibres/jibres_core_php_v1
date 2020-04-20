<?php
namespace content_love\domain\irnic;


class view
{
	public static function config()
	{
		\dash\face::title(T_("IRNIC"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		\dash\temp::set('disableDomainFetch', true);

		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_contact\search::get_list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\nic_contact\search::filter_message());

		$isFiltered = \lib\app\nic_contact\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
