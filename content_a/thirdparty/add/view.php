<?php
namespace content_a\thirdparty\add;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyAdd');
		// set usable variable
		$moduleType = \dash\request::get('type');

		// set default title
		$myTitle = T_('Add new third party');
		$myDesc  = T_('You can add new third party and after add with minimal data, we allow you to add extra detail.');
		// set badge

		$myBadgeLink = \dash\url::this();
		$myBadgeText = T_('Back to third parties list');


		// for special condition
		if($moduleType)
		{
			$myTitle = T_('Add new :type', ['type' => T_(ucfirst($moduleType))]);
			$myDesc  = T_('Add new :type with minmal data and after that you can add extra detail.', ['type' => T_(ucfirst($moduleType))]);


			$myBadgeLink = \dash\url::this(). '?type='. $moduleType;
			$myBadgeText = T_('Back to :type', ['type' => T_(ucfirst($moduleType. 's'))]);
		}

		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);
	}
}
?>
