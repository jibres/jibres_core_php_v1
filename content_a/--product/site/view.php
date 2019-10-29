<?php
namespace content_a\product\site;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_('site product!'). ' | '. \dash\data::dataRow_title());

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
