<?php
namespace content_domain\setting;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Domain setting"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::page_special(true);

	}
}
?>