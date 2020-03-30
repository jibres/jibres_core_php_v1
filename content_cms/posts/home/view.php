<?php
namespace content_cms\posts\home;


class view
{
	public static function config()
	{
		$moduleTypeTxt = \dash\request::get('type');
		$moduleType    = '';

		if(\dash\request::get('type'))
		{
			$moduleType = '?type='. \dash\request::get('type');
		}

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		$myType = \dash\request::get('type');

		$myTitle = T_("Posts");


		if($myType)
		{
			switch ($myType)
			{
				case 'page':
					$myTitle = T_('Pages');


					if(\dash\permission::check('cpPageAdd'))
					{
						\dash\data::action_text(T_('Add new page'));
						\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);
					}

					break;

				case 'help':
					$myTitle     = T_('Help Center');
					$myBadgeText = T_('Back to list of helps');


					if(\dash\permission::check('cpHelpCenterAdd'))
					{
						\dash\data::action_text(T_('Add new help center article'));
						\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);
					}
					break;

				case 'post':
					if(\dash\permission::check('cpPostsAdd'))
					{
						\dash\data::action_text(T_('Add new post'));
						\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);
					}
					break;

				default:
					\dash\header::status(404);
					\dash\data::action_text(T_('Add new post'));
					\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);
					break;
			}
		}
		else
		{
			if(\dash\permission::check('cpPostsAdd'))
			{
				\dash\data::action_text(T_('Add new post'));
				\dash\data::action_link(\dash\url::this(). '/add'. $moduleType);
			}
		}

		\dash\data::listSpecial(\dash\app\posts\special::list());
		// add back level to summary link

		\dash\face::title($myTitle);


		\dash\data::badge2_text(T_('Back to dashboard'));
		\dash\data::badge2_link(\dash\url::here());


		$search_string = \dash\request::get('q');
		if($search_string)
		{
			$myTitle .= ' | '. T_('Search for :search', ['search' => $search_string]);
		}

		$get_post_counter_args = [];
		$filterArray           = [];
		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];


		if(\dash\request::get('status'))
		{
			$args['status'] = \dash\request::get('status');
			$filterArray['status'] = $args['status'];
		}

		if(\dash\request::get('term'))
		{
			$args['term'] = \dash\request::get('term');
			$filterArray[T_("Category")] = $args['term'];
		}

		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}
		else
		{
			$args['type'] = 'post';
		}

		$get_post_counter_args['type'] = $args['type'];

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}


		if(!$args['sort'])
		{
			$args['sort'] = 'publishdate';
		}

		if(!\dash\permission::check('cpPostsViewAll'))
		{
			$args['user_id'] = \dash\user::id();
			$get_post_counter_args['user_id'] = $args['user_id'];
		}


		if(\dash\request::get('special'))
		{
			$args['special'] = \dash\request::get('special');
			$filterArray[T_("Special mode")] = T_(ucfirst($args['special']));

		}

		$args['language'] = \dash\language::current();
		$get_post_counter_args['language'] = $args['language'];

		\dash\data::sortLink(\content_cms\view::make_sort_link(\dash\app\posts::$sort_field, \dash\url::this()) );
		\dash\data::dataTable(\dash\app\posts::list(\dash\request::get('q'), $args) );

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);

		// get post count group by status
		$postCounter = \dash\app\posts::get_post_counter($get_post_counter_args);
		\dash\data::postCounter($postCounter);
	}
}
?>