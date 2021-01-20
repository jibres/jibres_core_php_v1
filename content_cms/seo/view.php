<?php
namespace content_cms\seo;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Smart SEO"));
		\dash\data::back_text(T_('CMS'));
		\dash\data::back_link(\dash\url::here());


		$args =
		[
			'order'      => 'desc',
			'sort'       => 'seorank',
			'limit'      => 5,
			'pagination' => 'n',
		];

		$search_string = \dash\validate::search(\dash\request::get('q'));
		$postList      = \dash\app\posts\search::list($search_string, $args);

		\dash\data::dataTable($postList);

		\dash\data::dashboardDetail(\dash\app\posts\dashboard::seo());
	}
}
?>