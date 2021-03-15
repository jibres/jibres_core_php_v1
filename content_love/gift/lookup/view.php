<?php
namespace content_love\gift\lookup;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift cards"));

			// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');

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
