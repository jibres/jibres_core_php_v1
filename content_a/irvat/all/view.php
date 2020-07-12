<?php
namespace content_a\irvat\all;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Income-cost factor list"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		// btn
		\dash\data::action_text(T_('Add new factor'));
		\dash\data::action_link(\dash\url::this(). '/add');

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\irvat\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['datecreated', 'factordate', 'title'], \dash\url::that());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\irvat\search::filter_message());

		$isFiltered = \lib\app\irvat\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		$summary = \lib\app\irvat\search::summary();
		\dash\data::summaryDetail($summary);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
