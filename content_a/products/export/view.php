<?php
namespace content_a\products\export;


class view
{
	public static function config()
	{
		// page title
		\dash\data::page_title(T_("Export products"));
		// back
		\dash\data::page_backText(T_('Products'));
		\dash\data::page_backLink(\dash\url::this());
		// support link
		\dash\data::page_help(\dash\url::support().'/products/export');
	}
}
?>
