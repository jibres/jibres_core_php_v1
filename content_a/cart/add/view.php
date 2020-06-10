<?php
namespace content_a\cart\add;


class view
{
	public static function config()
	{

		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Add cart'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
