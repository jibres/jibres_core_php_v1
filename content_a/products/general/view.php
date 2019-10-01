<?php
namespace content_a\products\general;


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

		\dash\data::page_pictogram('tag-2');

		// back to list of product
		\dash\data::badge_text(T_('Back'));
		\dash\data::badge_link(\dash\url::this());

	}
}
?>
