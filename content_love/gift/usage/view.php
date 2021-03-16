<?php
namespace content_love\gift\usage;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift card usage"));



		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		// \dash\data::listEngine_filter(\lib\app\gift\filter::list());
		\dash\data::listEngine_sort(false);
		\dash\data::sortList(\lib\app\gift\filter::sort_list());


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
			'gift_id' => \dash\request::get('gift_id'),

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\gift\usage\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\gift\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($args['gift_id'])
		{
			// btn
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/view?id='. $args['gift_id']);
		}
		else
		{
			// btn
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}
	}
}
?>
