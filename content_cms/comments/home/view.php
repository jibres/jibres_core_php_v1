<?php
namespace content_cms\comments\home;


class view
{
	public static function config($_args = [])
	{
		\dash\face::title(T_("Comments"));

		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());



		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(true);
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\comment\filter::sort_list());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'status' => \dash\request::get('status'),
			'post_id' => \dash\request::get('post_id'),
		];

		$args = array_merge($args, $_args);

		if(\dash\request::get('answerto'))
		{
			$args['parent']     = \dash\request::get('answerto');
			$args['product_id'] = null;
			$args['for']        = null;
		}


		$search_string = \dash\validate::search(\dash\request::get('q'));
		$postList      = \dash\app\comment\search::list($search_string, $args);

		\dash\data::dataTable($postList);

		$isFiltered = \dash\app\comment\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


	}
}
?>