<?php
namespace content_a\plugin\view;


class controller
{

	public static function routing()
	{
		if(!\dash\permission::supervisor())
		{
			\dash\header::status(404);
		}

		$plugin = \dash\url::subchild();

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