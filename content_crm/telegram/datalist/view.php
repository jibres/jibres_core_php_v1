<?php
namespace content_crm\telegram\datalist;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Telegram chat list"));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(false);
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\request::get('q');

		$list = \dash\app\telegram\search::list($search_string, $args);

		\dash\data::dataTable($list);


		$isFiltered = \dash\app\telegram\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
