<?php
namespace content_love\telegram\datalist;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Sms log"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());



		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\telegram\filter::list());

		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\telegram\filter::sort_list());

		$args =
		[
			'order'    => \dash\request::get('order'),
			'sort'     => \dash\request::get('sort'),
			'api_list' => 1,
		];

		$search_string = \dash\validate::search_string();


		$list = \dash\app\telegram\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \dash\app\changelog::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}



	}
}
?>
