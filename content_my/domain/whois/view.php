<?php
namespace content_my\domain\whois;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Whois'));
		\dash\face::desc(T_("Check domain"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>