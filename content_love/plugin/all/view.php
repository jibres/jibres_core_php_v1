<?php
namespace content_love\plugin\all;


class view
{
	public static function config()
	{
		\dash\face::title(T_("All plugin"));



		$args               = [];
		$args['category']   = \dash\request::get('category');


		$args['admin_list'] = 1;

		\dash\data::pluginAdminList(true);

		$plugin = \lib\app\plugin\search::list(\dash\request::get('q'), $args);

		\dash\data::pluginList(a($plugin, 'list'));
		\dash\data::pluginKeywords(a($plugin, 'keywords'));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
