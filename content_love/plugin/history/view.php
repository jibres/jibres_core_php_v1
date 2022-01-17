<?php
namespace content_love\plugin\history;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business plugin history"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(\lib\app\plugin\filter::list(\dash\url::child()));
		\dash\data::listEngine_sort(true);
		// \dash\data::sortList(\lib\app\plugin\filter::sort_list());

		$args =
		[
			// 'plugin' => 1,
			// 'order'    => \dash\request::get('order'),
			// 'sort'     => \dash\request::get('sort'),
			// 'user'     => \dash\request::get('user'),
			// 'fstatus' => \dash\request::get('fstatus'),
			// 'plugin' => \dash\request::get('plugin'),
			// 'business_id' => \dash\request::get('business_id'),

		];


		$search_string   = \dash\validate::search_string();
		$list = \lib\app\plugin\action\search::list($search_string, $args);

		\dash\data::dataTable($list);


	}
}
?>
