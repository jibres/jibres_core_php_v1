<?php
namespace content\press;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Press and Media'). ' | '. T_("Jibres"));
		\dash\data::page_desc(T_('Need HELP? Be patient...'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>