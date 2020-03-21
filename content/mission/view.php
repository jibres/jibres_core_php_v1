<?php
namespace content\mission;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Jibres Mission'));
		\dash\data::page_desc(T_("We are on a mission to simplify business system and their teams can spend more time creating money."));
		// btn
		\dash\data::back_text(T_('About Jibres'));
		\dash\data::back_link(\dash\url::kingdom(). '/about');
	}
}
?>