<?php
namespace content_business\author;

class view
{
	public static function config()
	{
		\dash\face::title(\lib\store::title(). ' | '. \dash\data::dataRow_title());

		if(\dash\data::myAuthor())
		{
			$args =
			[
				'user'       => \dash\data::myAuthor(),
			];

			$myPostList = \dash\app\posts\search::website_post(null, $args);
			\dash\data::myPostList($myPostList);
		}
	}
}
?>