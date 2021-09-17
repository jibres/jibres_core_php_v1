<?php
namespace content_a\discount\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Discount code"));

		\dash\data::action_text(T_('Add New Discount code'));
		\dash\data::action_link(\dash\url::this(). '/add');

		// back
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());
		\dash\data::back_direct(true);

		\dash\data::include_adminPanelBuilder(true);
	}
}
?>
