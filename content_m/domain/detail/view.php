<?php
namespace content_m\domain\detail;


class view
{
	public static function config()
	{
		\dash\data::page_title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>