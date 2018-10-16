<?php
namespace content_a\product\desc;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Description product!'). ' | '. \dash\data::dataRow_title());

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
