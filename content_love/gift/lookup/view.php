<?php
namespace content_love\gift\lookup;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift cards"));


		\dash\data::listEngine_start(true);



		$args =
		[

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\gift\lookup\search::list($search_string, $args);

		\dash\data::dataTable($list);

	}
}
?>
