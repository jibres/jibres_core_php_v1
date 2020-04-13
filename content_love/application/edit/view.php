<?php
namespace content_love\application\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Edit queue"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

	}
}
?>
