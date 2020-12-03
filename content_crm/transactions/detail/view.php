<?php
namespace content_crm\transactions\detail;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Transaction Detail"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>