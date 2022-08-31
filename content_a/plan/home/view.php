<?php
namespace content_a\plan\home;


use lib\app\plan\planCheck;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Plan"));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		// TODO need to set plan hashtag in help center
        \dash\face::help(\dash\url::support(). '/hashtag/plan');
		\dash\face::help(\dash\url::support());


		\dash\data::myPlanDetail(\lib\app\plan\businessPlanDetail::getMyCurrentPlanDetail());
//		var_dump(\dash\data::myPlanDetail());exit();


	}
}
?>
