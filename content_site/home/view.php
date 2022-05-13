<?php
namespace content_site\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Site Builder'));

		\dash\data::action_text(T_('Add New Page'));
		\dash\data::action_link(\dash\url::this(). '/page/new');

		\dash\data::back_text(T_('Dashboard'));
		// \dash\data::back_direct(true);
		\dash\data::back_link(\dash\url::kingdom(). '/a');

		\dash\data::include_adminPanelBuilder(true);

	}

}
?>