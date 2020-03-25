<?php
namespace content_management\application\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Application queue list"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'status' => \dash\request::get('status'),

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\application\queue_search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['id', 'status', 'daterequest', 'datedone'], \dash\url::this());
		\dash\data::sortLink($sortLink);

		\dash\data::filterBox(\lib\app\nic_domain\search::filter_message());

		$isFiltered = \lib\app\nic_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		// user search anything and no result founded
		if($search_string && !$list)
		{
			if(\dash\validate::domain($search_string))
			{
				\dash\data::myDomain($search_string);
				$check = \lib\app\nic_domain\check::check($search_string);
				\dash\data::checkResult($check);
			}
		}

		$group_by = \lib\app\application\queue_search::group_by_status();

		if(!is_array($group_by))
		{
			$group_by = [];
		}
		\dash\data::groupByType($group_by);
	}
}
?>
