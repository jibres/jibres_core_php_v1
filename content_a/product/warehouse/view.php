<?php
namespace content_a\product\warehouse;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Warehoust setting') . ' | '. \dash\data::dataRow_title());
		\dash\data::page_desc(T_('Manage warehouse setting of this product like count in each warehouse and some extra detail.'));
		\dash\data::page_pictogram('internet');


		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
