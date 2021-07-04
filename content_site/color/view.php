<?php
namespace content_site\color;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Color'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::include_adminPanelBuilder(true);

		\dash\data::myColor(color::list());

	}
}
?>