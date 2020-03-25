<?php
namespace content\whois;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Whois'));
		\dash\face::desc(T_("Check domain"));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>