<?php
namespace content\vision;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres Vision'));
		\dash\data::page_desc("World #1 Financial Platform.");
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		// btn
		\dash\data::action_text(T_('About'));
		\dash\data::action_link(\dash\url::kingdom(). '/about');
	}
}
?>