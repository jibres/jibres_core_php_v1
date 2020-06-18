<?php
namespace content_love\domain\onlineniclog\view;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains Log"));

		// btn
		\dash\data::back_text(T_('Log'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>
