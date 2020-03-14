<?php
namespace content_crm\transactions\add;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Plus charge account"));

		\dash\data::action_link(\dash\url::here(). '/transactions');
		\dash\data::action_text(T_('Back to transactions list'));
	}
}
?>