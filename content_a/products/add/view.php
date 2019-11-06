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


		// back
		\dash\data::page_backText(T_('Dashboard'));
		\dash\data::page_backLink(\dash\url::here());

		\dash\data::page_help(\dash\url::kingdom().'/support/test');


	}
}
?>
