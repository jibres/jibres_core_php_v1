<?php
namespace content_a\products\bullet;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');


		\dash\face::title(T_("Product feature bullet"));



		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/edit?id='. \dash\request::get('id'));


		if(\dash\data::productDataRow_url())
		{
			\dash\face::btnView(\dash\data::productDataRow_url());
		}

	}
}
?>
