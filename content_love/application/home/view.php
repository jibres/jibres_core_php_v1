<?php
namespace content_love\application\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Application queue list"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		if(\dash\permission::supervisor())
		{
			// btn
			\dash\data::action_text(T_('Show api log'));
			\dash\data::action_link(\dash\url::kingdom().'/su/apilog?urlmd5=e3a07be35d695e00396972af104e25e5');
		}


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'status' => \dash\request::get('status'),

		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\application\queue_search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['id', 'status', 'daterequest', 'datedone'], \dash\url::this());
		\dash\data::sortLink($sortLink);

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
