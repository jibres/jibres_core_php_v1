<?php
namespace content_support\ticket\tags;

class view
{

	public static function config()
	{


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
		$args['type'] = 'support_tag';


		$search_string = \dash\request::get('q');

		if($search_string)
		{
			$myTitle = T_('Search'). ' '.  $search_string;
		}

		$dataTable = \dash\app\term::list($search_string, $args);
		\dash\data::sortLink(\content_cms\view::make_sort_link(\dash\app\term::$sort_field, \dash\url::this()));
		\dash\data::dataTable($dataTable);

		if(\dash\request::get('edit'))
		{
			\dash\data::editMode(true);

			$id = \dash\request::get('edit');
			$dataRow = \dash\app\term::get($id);
			\dash\data::dataRow($dataRow);

			if(!$dataRow)
			{
				\dash\header::status(404, T_("Id not found"));
			}
		}

		// btn
		\dash\data::back_text(T_('Ticket'));
		\dash\data::back_link(\dash\url::support(). '/ticket');
	}

}
?>