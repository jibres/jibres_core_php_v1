<?php
namespace content_cms\terms;


class view
{
	public static function config()
	{

		$myTitle = T_("Terms");

		$myType = \dash\request::get('type');
		if($myType)
		{
			switch ($myType)
			{
				case 'cat':
				case 'category':
					\dash\permission::access('cpCategoryView');

					$myTitle = T_('Categories');

					break;

				case 'help_tag':
					\dash\permission::access('cpTagHelpView');

					$myTitle = T_('Tags');

					break;

				case 'support_tag':
					\dash\permission::access('cpTagSupportView');

					$myTitle = T_('Tags');

					break;

				case 'tag':
				default:
					\dash\permission::access('cpTagView');

					$myTitle = T_('Tags');

					break;
			}
		}
		else
		{
			\dash\permission::access('cpTagView');
		}

		\dash\face::title($myTitle);

		\dash\data::action_text(T_('Back to dashboard'));

		if(\dash\request::get('type') === 'support_tag')
		{
			\dash\data::action_link(\dash\url::kingdom(). '/support');
		}
		else
		{
			\dash\data::action_link(\dash\url::here());
		}


		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),

		];


		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if($myType)
		{
			if($myType === 'category')
			{
				$args['type'] = 'cat';
			}
			else
			{
				$args['type'] = $myType;
			}
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

		// set from controller
		// if(\dash\request::get('edit'))
		// {
		// 	\dash\data::editMode(true);

		// 	$id = \dash\request::get('edit');
		// 	$datarow = \dash\app\term::get($id);
		// 	\dash\data::datarow($datarow);

		// 	if(!$datarow)
		// 	{
		// 		\dash\header::status(404, T_("Id not found"));
		// 	}
		// }
	}
}
?>
