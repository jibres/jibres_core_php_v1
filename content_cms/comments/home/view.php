<?php
namespace content_cms\comments\home;


class view
{
	public static function config()
	{
		\dash\permission::access('cpCommentsView');

		\dash\face::title(T_("Comments"));


		// add back level to summary link
		\dash\data::badge2_text(T_('Back to dashboard'));
		\dash\data::badge2_link(\dash\url::here());


		$search_string            = \dash\request::get('q');
		if($search_string)
		{
			\dash\face::title(\dash\face::title(). ' | '. T_('Search for :search', ['search' => $search_string]));
		}

		$args =
		[
			'sort'  => \dash\request::get('sort'),
			'order' => \dash\request::get('order'),
		];

		if(\dash\request::get('status'))
		{
			$args['comments.status'] = \dash\request::get('status');
		}

		if(\dash\request::get('post_id'))
		{
			$args['comments.post_id'] = \dash\coding::decode(\dash\request::get('post_id'));
			if(!$args['comments.post_id'])
			{
				unset($args['post_id']);
			}
		}


		$get_comment_counter_args         = [];

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(!$args['sort'])
		{
			$args['sort'] = 'id';
		}

		\dash\data::sortLink(\content_cms\view::make_sort_link(\dash\app\comment::$sort_field, \dash\url::this()));
		\dash\data::dataTable(\dash\app\comment::list(\dash\request::get('q'), $args));

		$filterArray = $args;

		unset($filterArray['comments.status']);
		if(isset($filterArray['post_id']))
		{
			$filterArray['post_id'] = \dash\coding::encode($filterArray['post_id']);
		}

		// set dataFilter
		$dataFilter = \dash\app\sort::createFilterMsg($search_string, $filterArray);
		\dash\data::dataFilter($dataFilter);

		// get post count group by status
		$postCounter = \dash\app\comment::get_comment_counter($get_comment_counter_args);
		\dash\data::commentCounter($postCounter);

	}
}
?>