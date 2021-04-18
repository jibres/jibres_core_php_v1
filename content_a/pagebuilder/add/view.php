<?php
namespace content_a\pagebuilder\add;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new line'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$all_line = \lib\pagebuilder\line\add::list();
		\dash\data::lineList($all_line);

	}
}
?>