<?php
namespace content_subdomain\p\home;

class model
{
	public static function post()
	{
		if(\dash\request::post('cart') === 'add')
		{
			$result = \lib\app\cart\add::new_cart_website(\dash\request::post('product_id'), \dash\request::post('count'));
			\dash\redirect::to(\dash\url::kingdom(). '/cart');

		}
	}
}
?>