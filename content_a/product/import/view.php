<?php
namespace content_a\product\import;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Import product from CSV'));
		\dash\data::page_desc(T_('You can import more than one product in one request via CSV import process'));

		\dash\data::badge_text(T_('Back to product dashboard'));
		\dash\data::badge_link(\dash\url::this(). '/summary');
	}
}
?>
