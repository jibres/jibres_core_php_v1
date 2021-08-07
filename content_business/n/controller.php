<?php
namespace content_business\n;

class controller
{
	public static function routing()
	{

		// <link href="URL OF ORIGINAL PAGE" rel="canonical" />

		$child = \dash\url::child();
		if($child)
		{

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
}
?>