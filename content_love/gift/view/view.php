<?php
namespace content_love\gift\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit gift card"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');


		// btn
		\dash\data::action_text(T_('Edit gift card'));
		\dash\data::action_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));

		$dashboard_detail = \lib\app\gift\dashboard::card(\dash\request::get('id'));
		\dash\data::dashboardDetail($dashboard_detail);

	}
}
?>