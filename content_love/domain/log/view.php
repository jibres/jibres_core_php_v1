<?php
namespace content_love\domain\log;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains Log"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'type'  => \dash\request::get('type'),
			'result_code'  => \dash\request::get('result_code'),
			'user_id'  => \dash\request::get('user'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_log\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::that());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\nic_log\search::filter_message());

		$isFiltered = \lib\app\nic_log\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


		$group_by = \lib\app\nic_log\get::group_by_type();
		if(!is_array($group_by))
		{
			$group_by = [];
		}
		\dash\data::groupByType($group_by);

		$group_by_code = \lib\app\nic_log\get::group_by_code();
		if(!is_array($group_by_code))
		{
			$group_by_code = [];
		}
		\dash\data::groupByCode($group_by_code);
	}
}
?>
