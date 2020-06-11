<?php
namespace content_a\cart\add;

class model
{
	public static function post()
	{
		$user    = \dash\request::get('user');
		$product = \dash\request::post('product');
		$count   = \dash\request::post('count');

		if(\dash\request::post('type') === 'edit_count')
		{
			\lib\app\cart\edit::update_cart($product, $count, $user);
		}
		else
		{

			\lib\app\cart\add::new_cart($product, $count, $user);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
