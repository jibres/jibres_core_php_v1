<?php
namespace content_love\plugin\sync;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Sync all business"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
