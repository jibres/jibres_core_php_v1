<?php
namespace content_a\pagebuilder\manage;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Manage page'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/build'. \dash\request::full_get());

		$load_line = \lib\pagebuilder\tools\get::current_line_list();
		\dash\data::lineList($load_line);
	}
}
?>