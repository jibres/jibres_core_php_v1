<?php
namespace content_domain\dns\add;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add dns record"));

		\dash\data::page_special(true);

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>