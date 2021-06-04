<?php
namespace content_love\domain\onlineniclog;


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
			'ip'  => \dash\request::get('ip'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\onlinenic\log\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::that());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\onlinenic\log\search::filter_message());

		$isFiltered = \lib\app\onlinenic\log\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


		$group_by = \lib\app\onlinenic\log\get::group_by_type();
		if(!is_array($group_by))
		{
			$group_by = [];
		}
		\dash\data::groupByType($group_by);

		$group_by_code = \lib\app\onlinenic\log\get::group_by_code();
		if(!is_array($group_by_code))
		{
			$group_by_code = [];
		}
		\dash\data::groupByCode($group_by_code);
	}
}
?>
