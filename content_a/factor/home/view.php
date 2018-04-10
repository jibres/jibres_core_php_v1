<?php
namespace content_a\factor\home;


class view
{
	public static function config()
	{
		self::set_best_title();

		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
		];

		if(!$args['order'])
		{
			$args['order'] = 'DESC';
		}

		if(\dash\request::get('type'))
		{
			$args['type'] = \dash\request::get('type');
		}

		if(\dash\request::get('customer'))
		{
			$args['customer'] = \dash\request::get('customer');
		}

		\dash\data::dataTable(\lib\app\factor::list(\dash\request::get('q'), $args));

		\dash\data::myFilter(\content_a\filter::current(\lib\app\factor::$sort_field, \dash\url::this()));
		\dash\data::filterBox(\content_a\filter::createMsg($args));
	}


	private static function set_best_title()
	{
		// set usable variable
		$moduleType = \dash\request::get('type');

		\dash\data::moduleType($moduleType);
		\dash\data::moduleTypeP('?type='.$moduleType);


		// set default title
		$myTitle     = T_('List of factors');
		$myDesc      = T_('You can search in list of factors, add new factor or edit existing.');
		// set badge
		$myBadgeLink = \dash\url::this(). '/summary';
		$myBadgeText = T_('Back to factors summary');


		// // for special condition
		if($moduleType)
		{
			$myTitle     = T_('List of :type', ['type' => $moduleType]);
			$myDesc      = T_('Search in list of :type factors, add or edit them.', ['type' => $moduleType]);
			$myDesc      .= ' <a href="'. \dash\url::this() .'" data-shortkey="121">'. T_('List of all factors.'). '<kbd>f10</kbd></a>';

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
