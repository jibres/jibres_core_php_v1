<?php
namespace content_love\plugin\all\view;


class controller
{

	public static function routing()
	{
		$plugin = \dash\url::dir(3);

		if(!$plugin)
		{
			\dash\redirect::to(\dash\url::this());
		}


		$load_plugin = \lib\app\plugin\get::detail($plugin);
		if(!$load_plugin)
		{
			\dash\header::status(404, T_("plugin key is invalid"));
		}

		\dash\data::pluginKey($plugin);
		\dash\data::pluginDetail($load_plugin);

		// allow load and post to this url
		\dash\open::get();
		\dash\open::post();
	}
}
?>