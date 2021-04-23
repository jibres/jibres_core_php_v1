<?php
namespace content_a\pagebuilder\edittitle;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit page title'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/build'. \dash\request::full_get());

		$get       = \dash\request::get();
		$load_line = \lib\pagebuilder\tools\search::list($get);
		\dash\data::lineList($load_line);
	}
}
?>