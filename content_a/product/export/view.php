<?php
namespace content_a\product\export;


class view
{
	public static function config()
	{
		\dash\permission::access('aProductExport');
		\dash\data::page_title(T_('Export product to CSV'));
		\dash\data::page_desc(T_('You can export all product to CSV file'));

		\dash\data::badge_text(T_('Back to product dashboard'));
		\dash\data::badge_link(\dash\url::this(). '/summary');
	}
}
?>
