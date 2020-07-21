<?php
namespace content_business\orders\view;


class model
{
	public static function post()
	{
		if(\dash\request::post('cart') === 'buy')
		{
			$result = \lib\app\cart\add::new_cart_website(\dash\request::post('product_id'), \dash\request::post('count'));

		}

		if(\dash\request::post('cart') === 'add')
		{
			$result = \lib\app\cart\add::new_cart_website(\dash\request::post('product_id'), \dash\request::post('count'));
		}

		if(\dash\request::post('set_status') === 'cancel')
		{
			\lib\app\factor\edit::user_cancel(\dash\request::get('id'));
			\dash\redirect::pwd();
		}
	}
}
?>
