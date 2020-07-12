<?php
namespace content_a\irvat\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Income-cost management"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

				// btn
		\dash\data::action_text(T_('Add new factor'));
		\dash\data::action_link(\dash\url::this(). '/add');

		$dashboard = \lib\app\irvat\dashboard::summary();
		\dash\data::dashboradDetail($dashboard);


	}
}
?>