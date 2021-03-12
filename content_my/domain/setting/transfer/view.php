<?php
namespace content_my\domain\setting\transfer;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain lock setting"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?domain='. \dash\request::get('domain'));

	}
}
?>