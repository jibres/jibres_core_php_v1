<?php
namespace content_a\site\section;


class view
{
	public static function config()
	{
		\dash\data::include_adminPanelBuilder("true");

		\dash\face::title(T_('Add new line'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/builder'. \dash\request::full_get());


		$all_line = \lib\pagebuilder\tools\add::body_list();
		\dash\data::lineList($all_line);

	}
}
?>