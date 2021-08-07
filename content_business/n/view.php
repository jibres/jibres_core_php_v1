<?php
namespace content_business\n;

class view
{
	public static function config()
	{
		if(\dash\data::dataRow_link() && \dash\data::dataRow_link() != \dash\url::this())
		{
			// set url canonical \dash\data::dataRow_link();
		}

		if(!\dash\url::child())
		{
			\dash\data::displayShowPostList(true);


			$args =
			[
				'website_order' => \dash\request::get('order'),
				'subtype'       => \dash\request::get('subtype'),
				'website_mode'  => true,
			];

			$search_string = \dash\validate::search_string();
			$postList      = \dash\app\posts\search::list($search_string, $args);

			\dash\data::dataTable($postList);

			$isFiltered = \dash\app\posts\search::is_filtered();
			\dash\data::isFiltered($isFiltered);

			if($isFiltered)
			{
				\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
			}
		}
	}
}
?>