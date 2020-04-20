<?php
namespace content_my\domain\short;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Suggestion Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'domainlen' => 3,
			'available' => true,
			'tld'       => 'ir',

		];

		$search_string = \dash\request::get('q');

		$list          = \lib\app\domains\search::list($search_string, $args);
		$filterBox     = \lib\app\domains\search::filter_message();
		$isFiltered    = \lib\app\domains\search::is_filtered();


		\dash\data::filterBox($filterBox);

		\dash\data::dataTable($list);

		\dash\data::isFiltered($isFiltered);


		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::that());
		\dash\data::sortLink($sortLink);

	}
}
?>
