<?php
namespace content_a\plan\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Jibres Plan"));

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::planList(\lib\app\plan\planList::listByDetail());

		// load budget from jibres api
		$my_jibres_budget = \lib\api\jibres\api::budget();
		\dash\data::myBudget($my_jibres_budget);
	}
}
?>
