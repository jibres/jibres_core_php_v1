<?php
namespace content_crm\member\message;


class view
{
	public static function config()
	{

		\content_crm\member\master::view();

		\dash\face::title(T_('Customer Notifications'));



		\dash\data::listEngine_start(true);
		// \dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(true);
		// \dash\data::listEngine_sort(true);

		// btn
		\dash\data::action_text(T_('Add New Notifications'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::that(). '/add'. \dash\request::full_get());

		\dash\data::listEngine_start(true);
		// \dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			// 'show_type' => 'user',
			'notif'     => 1,
			'to'      => \dash\coding::decode(\dash\request::get("id")),
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
