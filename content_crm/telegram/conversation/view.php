<?php
namespace content_crm\telegram\conversation;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Conversation"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Telegram'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\sms\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\telegram\filter::sort_list());


		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'conversation' => 1,

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
