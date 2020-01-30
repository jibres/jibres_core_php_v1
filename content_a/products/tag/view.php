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

		if(isset($args['type']) && $args['type'] === 'cat')
		{
			if(!\dash\permission::check('cpCategoryView'))
			{
				// @check
			}
		}

		$search_string = \dash\request::get('q');

		if($search_string)
		{
			$myTitle = T_('Search'). ' '.  $search_string;
		}


		$dataTable = \dash\app\term::list($search_string, $args);
		\dash\data::sortLink(\content_cms\view::make_sort_link(\dash\app\term::$sort_field, \dash\url::this()));
		\dash\data::dataTable($dataTable);

	}
}
?>
