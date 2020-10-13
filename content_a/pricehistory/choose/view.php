<?php
namespace content_a\pricehistory\choose;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Choose product'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');

	}
}
?>
