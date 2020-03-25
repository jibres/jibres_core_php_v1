<?php
namespace content\help;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Help Center'));
		\dash\data::page_desc(T_('Need HELP? Be patient...'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>