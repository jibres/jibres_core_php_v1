<?php
namespace content_my\domain\import;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Import domain"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>