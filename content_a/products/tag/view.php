<?php
namespace content_a\products\tag;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Tags'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');

		$args =
		[
			'order' => 'desc',
			'sort'  => 'id',

		];

		$search_string = \dash\request::get('q');

		$dataTable = \lib\app\product\tag::list($search_string, $args);
		\dash\data::sortLink(\content_cms\view::make_sort_link(['id', 'title', 'slug', 'status'], \dash\url::that()));

		$dataFilter = \dash\app\sort::createFilterMsg($search_string, []);
		\dash\data::dataFilter($dataFilter);

		\dash\data::dataTable($dataTable);

	}
}
?>
