<?php
namespace content_a\pagebuilder\choose;


class view
{
	public static function config()
	{
		if(\dash\data::pagebuilderMode() === 'header')
		{
			\dash\face::title(T_('Choose header'));
			$all_line = \lib\pagebuilder\tools\add::header_list();
		}
		else
		{
			\dash\face::title(T_('Choose footer'));
			$all_line = \lib\pagebuilder\tools\add::footer_list();
		}

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());



		\dash\data::lineList($all_line);

	}
}
?>