<?php
namespace content_a\report\productvalue;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Product value'));

		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');
	}
}
?>