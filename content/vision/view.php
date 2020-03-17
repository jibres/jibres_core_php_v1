<?php
namespace content\vision;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres Vission'));
		\dash\data::page_desc("We are on a mission to simplify business system and their teams can spend more time creating money.");
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		// btn
		\dash\data::action_text(T_('Our Vision'));
		\dash\data::action_link(\dash\url::kingdom(). '/vision');
	}
}
?>