<?php
namespace content_domain\dns\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit dns record"));

		\dash\data::page_special(true);

		// btn
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::this());

	}
}
?>