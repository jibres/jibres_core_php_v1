<?php
namespace content_a\plugin\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Jibres plugins"));


		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
		\dash\data::back_direct(true);

		\dash\data::include_adminPanelBuilder(true);


		$args             = [];
		$args['category'] = \dash\request::get('category');

		$plugin = \lib\app\plugin\search::list(\dash\request::get('q'), $args);

		\dash\data::pluginList(a($plugin, 'list'));
		\dash\data::pluginKeywords(a($plugin, 'keywords'));



	}
}
?>
