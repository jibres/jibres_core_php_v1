<?php
namespace content_a\plan\set;


use lib\app\plan\planCheck;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Set plan"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/choose');

		// TODO need to set plan hashtag in help center
        \dash\face::help(\dash\url::support(). '/hashtag/plan');
		\dash\face::help(\dash\url::support());


		\dash\data::myPlanDetail(\lib\app\plan\businessPlanDetail::getMyCurrentPlanDetail());


	}
}
?>
