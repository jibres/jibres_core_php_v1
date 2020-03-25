<?php
namespace content_a\products\duplicate;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		// set page title from product title
		$product_title = \dash\data::productDataRow_title();
		if(!isset($product_title))
		{
			$product_title = T_("Whitout name");
		}

		\dash\face::title(T_("Make copy from :val", ['val' => $product_title]));


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. $id);

		// \dash\data::page_help(\dash\url::support().'/product/duplicate');

	}
}
?>
