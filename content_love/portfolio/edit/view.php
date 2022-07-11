<?php
namespace content_love\changelog\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit changelog"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listChangelogTag(\dash\app\changelog::list_changelog_tags());

		$currentTag = [];
		$currentTag[] = \dash\data::dataRow_tag1();
		$currentTag[] = \dash\data::dataRow_tag2();
		$currentTag[] = \dash\data::dataRow_tag3();
		$currentTag[] = \dash\data::dataRow_tag4();
		$currentTag[] = \dash\data::dataRow_tag5();

		$currentTag = array_filter($currentTag);
		$currentTag = array_unique($currentTag);

		\dash\data::currentTag($currentTag);


	}
}
?>
