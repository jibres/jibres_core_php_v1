<?php
namespace content_domain\setting;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Domain setting"));

		// btn
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::here());

		\dash\data::page_special(true);

	}
}
?>