<?php
namespace content_love\apilog\twitter;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Api Log"));



		\dash\data::listEngine_start(true);


		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		$search_string = \dash\validate::search_string();
		if($search_string)
		{
			$myTitle .= ' | '. T_('Search for :search', ['search' => $search_string]);
		}

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];


		$dataTable = \lib\app\twitter\search::list(\dash\validate::search_string(), $args);


		\dash\data::dataTable($dataTable);

	}
}
?>