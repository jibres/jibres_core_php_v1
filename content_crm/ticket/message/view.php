<?php
namespace content_crm\ticket\message;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Messages"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Tickets'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);


		$args =
		[
			'order'        => \dash\request::get('order'),
			'sort'         => \dash\request::get('sort'),
			'status'       => \dash\request::get('status'),
			'so'           => \dash\request::get('so'),
			'user'         => \dash\request::get('user'),
			'message_mode' => true,

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
