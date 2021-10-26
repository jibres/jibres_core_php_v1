<?php
namespace content_a\plugin\view;


class controller
{

	public static function routing()
	{
		$plugin_key = \dash\url::subchild();

		if(!$plugin_key)
		{
			\dash\redirect::to(\dash\url::this());
		}


		$load_plugin = \lib\app\plugin\get::detail($plugin_key);
		if(!$load_plugin)
		{
			\dash\header::status(404, T_("plugin key is invalid"));
		}

		\dash\data::pluginKey($plugin_key);
		\dash\data::pluginDetail($load_plugin);

		// allow load and post to this url
		\dash\open::get();
		\dash\open::post();
	}
}
?>