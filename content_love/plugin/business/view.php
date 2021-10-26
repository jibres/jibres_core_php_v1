<?php
namespace content_love\plugin\business;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business plugin"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\store\filter::list(\dash\url::child()));
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\store\filter::sort_list());

		$args =
		[
			'plugin' => 1,
			'order'    => \dash\request::get('order'),
			'sort'     => \dash\request::get('sort'),
			'user'     => \dash\request::get('user'),
			'fstatus' => \dash\request::get('fstatus'),
			'plugin' => \dash\request::get('plugin'),
			'business_id' => \dash\request::get('business_id'),

		];


		$search_string   = \dash\validate::search_string();
		$list = \lib\app\store\search::list_admin($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\store\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
