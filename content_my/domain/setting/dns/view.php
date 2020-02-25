<?php
namespace content_my\domain\setting\dns;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Domain DNS Setting"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::page_special(true);
		// j(\dash\data::domainDetail());

	}
}
?>