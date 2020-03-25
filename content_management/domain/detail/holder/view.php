<?php
namespace content_management\domain\detail\holder;


class view
{
	public static function config()
	{
		\dash\face::title(\dash\data::domainDetail_name());

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>