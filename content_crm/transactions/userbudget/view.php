<?php
namespace content_crm\transactions\userbudget;

class view
{
	public static function config()
	{
		\dash\face::title(T_("User budget list"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(\dash\app\user\filter::list());
		// \dash\data::listEngine_sort(false);
		// \dash\data::sortList(\dash\app\user\filter::sort_list());


		$args =
		[
			// 'order'      => \dash\request::get('order'),
			// 'sort'       => \dash\request::get('sort'),
			// 'status'     => \dash\request::get('status'),
			// 'permission' => \dash\request::get('permission'),
			// 'hm'         => \dash\request::get('hm'),
			// 'ho'         => \dash\request::get('ho'),
			// 'hc'         => \dash\request::get('hc'),
			// 'hp'         => \dash\request::get('hp'),
			'show_budget'  => true,
		];





		$search_string   = \dash\validate::search_string();
		$userList = \dash\app\user\search::list($search_string, $args);

		\dash\data::dataTable($userList);

		$isFiltered = \dash\app\user\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>