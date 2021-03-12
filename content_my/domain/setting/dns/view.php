<?php
namespace content_my\domain\setting\dns;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain DNS"));

				// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?domain='. \dash\request::get('domain'));
	}
}
?>