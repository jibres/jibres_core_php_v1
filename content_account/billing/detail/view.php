<?php
namespace content_account\billing\detail;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Billing usage detail"));
		\dash\data::detail([]);

		\dash\data::back_link(\dash\url::here(). '/billing');
		\dash\data::back_text(T_('Back'));

	}

}
?>