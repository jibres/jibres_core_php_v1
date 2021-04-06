<?php
namespace content_my\domain\other;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnImport(\dash\url::this().'/import');
		// \dash\face::btnExport(\dash\url::this().'/export');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\domains\filter::list());
		\dash\data::listEngine_before(root. 'content_my/domain/other/display-search-before.php');
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\domains\filter::sort_list());


		$urlGetList = \dash\request::get('list');

		$data_list  = $urlGetList ? $urlGetList : 'renew';

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'list'      => $data_list,
			'lock'      => \dash\request::get('lock'),
			'autorenew' => \dash\request::get('autorenew'),
			// 'status' => \dash\request::get('status'),

		];


		$search_string = \dash\request::get('q');

		$list          = \lib\app\nic_domain\search::list($search_string, $args);
		$filterBox     = \lib\app\nic_domain\search::filter_message();
		$isFiltered    = \lib\app\nic_domain\search::is_filtered();


		$count_group_by_status = \lib\app\nic_domain\dashboard::count_group_by_status();
		\dash\data::groupByStatus($count_group_by_status);

		\dash\data::filterBox($filterBox);

		\dash\data::dataTable($list);

		\dash\data::isFiltered($isFiltered);


		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


	}

}
?>
