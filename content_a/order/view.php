<?php
namespace content_a\order;


class view
{
	public static function config()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Sale Order'));


		if(\dash\permission::check('factorSaleList'))
		{
			\dash\data::back_text(T_('Orders'));
			\dash\data::back_link(\dash\url::here(). '/factor?type=sale');
		}

	}
}
?>
