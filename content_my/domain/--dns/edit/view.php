<?php
namespace content_my\domain\dns\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit dns record"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());

	}
}
?>