<?php
namespace content_a\thirdparty\home;


class view
{
	public static function config()
	{
		self::set_best_title();

		$args = [];

		$type = \dash\request::get('type');

		if($type && in_array($type, ['customer', 'staff', 'supplier']))
		{
			$args[$type] = 1;
		}

		$args['order'] = 'desc';
		\dash\data::dataTable(\lib\app\thirdparty::list(\dash\request::get('q'), $args));

		\dash\data::filterBox(\content_a\filter::createMsg($args));
		\dash\data::dashboardData(\lib\app\store::dashboard_detail(\lib\store::id()));
	}



	private static function set_best_title()
	{
		// set usable variable
		$moduleType  = \dash\request::get('type');

		// set default title
		$myTitle     = T_('List of third parties');
		$myDesc      = T_('All type of poeple or companies like customers, staffs and supplisers is known as third parties that work with your store is exist here');
		// set badge
		$myBadgeLink = \dash\url::this(). '/add';
		$myBadgeText = T_('Add new third party');


		// for special condition
		if($moduleType)
		{
			$myTitle     = T_('List of :type', ['type' => $moduleType.'s']);
			$myDesc      = T_('Search in list of :type, add and edit and manage them.', ['type' => $moduleType.'s']);
			$myDesc      .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all third parties.'). '<kbd>f10</kbd></a>';


			$myBadgeLink = \dash\url::this(). '/add?type='. $moduleType;
			$myBadgeText = T_('Add new :type', ['type' => $moduleType]);
		}

		\dash\data::page_title($myTitle);
		\dash\data::page_desc($myDesc);

		\dash\data::badge_text($myBadgeText);
		\dash\data::badge_link($myBadgeLink);
	}
}
?>
