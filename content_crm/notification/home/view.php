<?php
namespace content_crm\notification\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Notifications"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));


		\dash\data::listEngine_start(true);
		// \dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'notif' => 1,

		];

		$search_string = \dash\request::get('q');

		$list = \dash\app\log\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \dash\app\log\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
