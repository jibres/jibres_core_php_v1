<?php
namespace content_a\report\products;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product setting'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');
	}
}
?>