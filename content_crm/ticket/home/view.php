<?php
namespace content_crm\ticket\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Tickets"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));

		\dash\data::action_link(\dash\url::this(). '/add');
		\dash\data::action_text(T_('Add new ticket'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(true);
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\ticket\filter::sort_list());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'status'   => \dash\request::get('status'),
			'so'   => \dash\request::get('so'),
			'user'   => \dash\request::get('user'),

		];

		$search_string = \dash\request::get('q');

		$list = \dash\app\ticket\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \dash\app\ticket\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
