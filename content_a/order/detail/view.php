<?php
namespace content_a\order\detail;


class view
{
	public static function config()
	{

		\dash\face::title(T_('Order detail'));

		\dash\data::back_text(T_('Orders'));
		\dash\data::back_link(\dash\url::this());

		// if have user
		// load user address
		//
		// load pay type from business setting
		//
	}
}
?>
