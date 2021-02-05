<?php
namespace content_crm\sms\conversation;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Conversation"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('SMS'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\sms\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\sms\filter::sort_list());


		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'status'       => \dash\request::get('status'),
			'mobile'       => \dash\request::get('mobile'),
			'conversation' => 1,

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\sms\search::list($search_string, $args);

		\dash\data::dataTable($list);


		$isFiltered = \lib\app\sms\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
