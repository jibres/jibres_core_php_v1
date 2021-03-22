<?php
namespace content_love\store\setting;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Stores setting"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
