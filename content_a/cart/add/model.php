<?php
namespace content_a\cart\add;

class model
{
	public static function post()
	{
		$user    = \dash\request::get('user');
		$guestid = \dash\request::get('guestid');
		$product = \dash\request::post('product');
		$count   = \dash\request::post('count');

		if(\dash\request::post('type') === 'edit_count')
		{
			\lib\app\cart\edit::edit($product, $count, $user, $guestid);
		}
		elseif(\dash\request::post('type') === 'remove')
		{
			\lib\app\cart\remove::from_cart_admin($product, $user, $guestid);
		}
		else
		{
			\lib\app\cart\add::new_cart_admin($product, $count, $user, $guestid);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
