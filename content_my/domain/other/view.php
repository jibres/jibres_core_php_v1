<?php
namespace content_my\domain\other;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Other Domains"));

		// btn
		\dash\data::back_text(T_('Domain Center'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnImport(\dash\url::this().'/import');
		// \dash\face::btnExport(\dash\url::this().'/export');

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\domains\filter::list());
		\dash\data::listEngine_before(root. 'content_my/domain/other/display-search-before.php');
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\domains\filter::sort_list());


		$count_group_by_status = \lib\app\nic_domain\dashboard::count_group_by_status();
		\dash\data::groupByStatus($count_group_by_status);

		$urlGetList = \dash\request::get('list');

		if($urlGetList)
		{
			$data_list  = $urlGetList; // ? $urlGetList : 'renew';
			\dash\face::title(T_("Other Domains"). ' - '. T_($urlGetList));
		}
		else
		{
			if(a($count_group_by_status, 'maybe') == 0)
			{
				if(a($count_group_by_status, 'imported') == 0)
				{
					if(a($count_group_by_status, 'available') == 0)
					{
						$data_list = 'renew';
					}
					else
					{
						$data_list = 'available';
					}
				}
				else
				{
					$data_list = 'import';
				}
			}
			else
			{
				$data_list = 'renew';
			}
		}

		$count_group_by_status_link = 0;

		foreach ($count_group_by_status as $key => $value)
		{
			if(floatval($value) > 0)
			{
				$count_group_by_status_link++;
			}
		}

		\dash\data::countGroupByStatusLink($count_group_by_status_link);


		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'list'      => $data_list,
			'lock'      => \dash\request::get('lock'),
			'autorenew' => \dash\request::get('autorenew'),
			// 'status' => \dash\request::get('status'),

		];


		$search_string = \dash\validate::search_string();

		$list          = \lib\app\nic_domain\search::list($search_string, $args);
		$filterBox     = \lib\app\nic_domain\search::filter_message();
		$isFiltered    = \lib\app\nic_domain\search::is_filtered();


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
