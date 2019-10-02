<?php
namespace content_a\products\edit;


class view
{
	public static function config()
	{
		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Whitout name");
		}

		\dash\data::page_title($title);

		// back to list of product
		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::this());

		$variants_list = \lib\app\product2\variants::get(\dash\request::get('code'));
		\dash\data::variantsList($variants_list);

	}
}
?>
