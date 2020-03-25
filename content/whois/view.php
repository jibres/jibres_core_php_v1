<?php
namespace content\whois;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Whois'));
		\dash\data::page_desc(T_("Check domain"));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>