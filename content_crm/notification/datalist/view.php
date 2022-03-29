<?php
namespace content_crm\notification\datalist;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Notifications"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Notifications'));


		\dash\data::listEngine_start(true);
		// \dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\sms\filter::list());
		\dash\data::listEngine_sort(false);


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'notif' => 1,
			'touser' => \dash\request::get('touser'),
			'include_expired' => true,

		];

		$search_string = \dash\validate::search_string();

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
