<?php
namespace content_n\home;

class controller
{
	public static function routing()
	{

		// <link href="URL OF ORIGINAL PAGE" rel="canonical" />

		$module = \dash\url::module();
		if(!$module)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		$load = \dash\app\posts\find::post();

		if(!$load)
		{
			\dash\header::status(404, T_("Post not found"));
		}

		\dash\temp::set('inContentNHomeController', true);
		\dash\temp::set('ThePostLoadedInContentN', $load);

		\dash\open::get();

	}
}
?>