<?php
namespace content_a\products\sharetext;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		// set page title from product title
		$title = \dash\data::productDataRow_title();
		if(!isset($title))
		{
			$title = T_("Without name");
		}

		\dash\face::title(T_("Product Share text"). ' | '. $title);


		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));


		if(\dash\data::productDataRow_url())
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}

		\dash\face::help(\dash\url::support().'/product');




	}
}
?>
