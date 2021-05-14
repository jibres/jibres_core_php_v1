<?php
namespace content_a\products\desc;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		\dash\face::title(T_("Product description"));

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
