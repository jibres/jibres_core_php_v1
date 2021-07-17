<?php
namespace content_a\accounting\irvat\all;


class view
{
	public static function config()
	{
		\content_a\accounting\doc\view::config(['template' => 'factor']);

		$args = \dash\temp::get('irvatArgs');

		$args['summary_mode'] = true;

		$summaryDetail = \lib\app\tax\doc\search::list(null, $args);

		\dash\data::summaryDetail($summaryDetail);

		\dash\face::btnInsert('');
		\dash\face::btnInsertText('');

		\dash\data::docListModeFactor(true);
		\dash\data::userToggleSidebar(false);

		\dash\face::title(T_("Income-cost factor list"));


		// // btn
		// \dash\data::back_text(T_('Back'));
		// \dash\data::back_link(\dash\url::this());

		// // btn
		// \dash\data::action_text(T_('Add new factor'));
		// \dash\data::action_link(\dash\url::that(). '/add');

		// $args =
		// [
		// 	'order'    => \dash\request::get('order'),
		// 	'sort'     => \dash\request::get('sort'),
		// 	'season'   => \dash\request::get('season'),
		// 	'year'     => \dash\request::get('year'),
		// 	'seller'   => \dash\request::get('seller'),
		// 	'customer' => \dash\request::get('customer'),
		// 	'vat' => \dash\request::get('vat'),
		// 	'official' => \dash\request::get('official'),
		// ];

		// $search_string = \dash\validate::search_string();

		// $list = \lib\app\irvat\search::list($search_string, $args);

		// \dash\data::dataTable($list);

		// $sortLink = \dash\app\sort::make_sortLink(['datecreated', 'factordate', 'title'], \dash\url::current());
		// \dash\data::sortLink($sortLink);


		// \dash\data::filterBox(\lib\app\irvat\search::filter_message());

		// $isFiltered = \lib\app\irvat\search::is_filtered();
		// \dash\data::isFiltered($isFiltered);

		// $summary = \lib\app\irvat\search::summary();
		// \dash\data::summaryDetail($summary);

		// if($isFiltered)
		// {
		// 	\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		// }

	}
}
?>
