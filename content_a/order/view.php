<?php
namespace content_a\order;


class view
{
	public static function config()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Sale invoicing'));


		if(\dash\permission::check('factorSaleList'))
		{
			\dash\data::back_text(T_('Factors'));
			\dash\data::back_link(\dash\url::here(). '/factor?type=sale');
		}

		\lib\app\fund\login::check();

		\lib\app\pos\tools::pc_pos_btn();
	}
}
?>
