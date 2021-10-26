<?php
namespace content_love\plugin\manage;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Manage Business plugin"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/business');

		$plugin_list = \lib\plugin\business::admin_list(\dash\request::get('id'));

		\dash\data::pluginList($plugin_list);



		$all_plugin = \lib\plugin\get::all_list();

		\dash\data::allplugin($all_plugin);


	}
}
?>
