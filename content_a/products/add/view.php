<?php
namespace content_a\products\add;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Add product"));

		// back to list of product
		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::this());

	}
}
?>
