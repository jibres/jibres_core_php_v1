<?php
namespace content_crm\log\enter;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Last login"));

		// btn
		\dash\data::back_text(T_('CRM'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'status'    => \dash\request::get('status'),
			'show_type' => 'user',
			'caller'    => 'enter_NewAccountLogin',
		];

		$search_string   = \dash\validate::search(\dash\request::get('q'));
		$logList = \dash\app\log\search::list($search_string, $args);

		\dash\data::dataTable($logList);

		$isFiltered = \dash\app\log\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


	}

}
?>