<?php
namespace content_a\order\products;


class view
{
	public static function config()
	{

		// show dropdown of product list
		\lib\app\product\site_list::dropdown();

		\dash\face::title(T_('Manage order'));

		$user = \dash\request::get('user');
		$guestid = \dash\request::get('guestid');

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


	}
}
?>
