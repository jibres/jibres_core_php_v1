<?php
namespace content_a\products\tag;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Tags'));

		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),

		];

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		$args['language'] = \dash\language::current();
		$search_string = \dash\request::get('q');

		$dataTable = \lib\app\product\tag::list($search_string, $args);
		\dash\data::sortLink(\content_cms\view::make_sort_link(['id', 'title', 'slug', 'status'], \dash\url::that()));

		$dataFilter = \dash\app\sort::createFilterMsg($search_string, []);
		\dash\data::dataFilter($dataFilter);

		\dash\data::dataTable($dataTable);

	}
}
?>
