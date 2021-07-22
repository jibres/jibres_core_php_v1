<?php
namespace content_love\changelog\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Add new changelog"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listChangelogTag(\dash\app\changelog::list_changelog_tags());


	}
}
?>
