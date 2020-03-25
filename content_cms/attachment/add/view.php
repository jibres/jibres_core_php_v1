<?php
namespace content_cms\attachment\add;

class view
{
	public static function config()
	{
		\dash\permission::access('cpPostsAdd');

		$moduleTypeTxt = 'attachemnt';
		$moduleType    = 'attachemnt';

		\dash\data::moduleTypeTxt($moduleTypeTxt);
		\dash\data::moduleType($moduleType);

		$myTitle   = T_("Add new attachemnt");
		$myBadgeLink = \dash\url::this();
		$myBadgeText = T_('Back to list of attachemnt');

		\dash\face::title($myTitle);

		\dash\data::action_text($myBadgeText);
		\dash\data::action_link($myBadgeLink);

		\content_cms\posts\main\view::myDataType();
	}
}
?>