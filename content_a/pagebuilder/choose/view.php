<?php
namespace content_a\pagebuilder\choose;


class view
{
	public static function config()
	{
		$subchild = \dash\url::subchild();
		\dash\data::chooseType($subchild);

		if($subchild === 'header')
		{
			\dash\face::title(T_('Choose header'));
			$all_line = \lib\app\pagebuilder\header\add::list();
		}
		else
		{
			\dash\face::title(T_('Choose footer'));
			$all_line = \lib\app\pagebuilder\footer\add::list();
		}

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());



		\dash\data::lineList($all_line);

	}
}
?>