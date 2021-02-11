<?php
namespace content_love\domain\autorenew;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());




	}
}
?>
