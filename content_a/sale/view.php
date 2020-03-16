<?php
namespace content_a\sale;


class view
{
	public static function config()
	{
		// show dropdown of product list
		\lib\app\product\site_list::dropdown();


		\dash\data::page_title(T_('Sale invoicing'));
		// \dash\data::page_desc(T_('Sale your product via Jibres and enjoy using integrated web base platform.'));


		if(\dash\permission::check('factorSaleList'))
		{
			\dash\data::action_text(T_('Back to last sales'));
			\dash\data::action_link(\dash\url::here(). '/factor?type=sale');
		}


		\lib\app\pos\tools::pc_pos_btn();
	}
}
?>
