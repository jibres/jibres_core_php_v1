<?php
namespace content_crm\transactions\minus;

class view
{
	public static function config()
	{
		\dash\face::title(T_("Minus charge account"));

		\dash\data::action_link(\dash\url::here(). '/transactions');
		\dash\data::action_text(T_('Back to transactions list'));
	}
}
?>