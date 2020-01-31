<?php
namespace content_a\products\tag;


class view
{
	public static function config()
	{


		$myTitle = T_('Tags');
		$myDesc  = T_("Check tags and add or edit some new tag");
		\dash\data::page_pictogram('tags');


		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		// back
		\dash\data::page_backText(T_('Products'));
		\dash\data::page_backLink(\dash\url::this());


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
		\dash\data::sortLink(\content_cms\view::make_sort_link(['id', 'title'], \dash\url::that()));

		\dash\data::dataTable($dataTable);

	}
}
?>
