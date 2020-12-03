<?php
namespace content_crm\member\transactions\detail;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Transaction Detail"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). \dash\request::full_get(['tid' => null]));

	}
}
?>