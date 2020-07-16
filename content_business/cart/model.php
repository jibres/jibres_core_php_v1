<?php
namespace content_business\cart;


class model
{
	public static function post()
	{
		$product_id = \dash\request::post('product_id');

		if(\dash\request::post('type') === 'minus_cart')
		{
			$result = \lib\app\cart\edit::update_cart($product_id, 1, null, 'minus_count');
			if($result)
			{
				\dash\redirect::pwd();
			}
		}
		elseif(\dash\request::post('type') === 'plus_cart')
		{
			$result = \lib\app\cart\edit::update_cart($product_id, 1, null, 'plus_count');
			if($result)
			{
				\dash\redirect::pwd();
			}
		}
		elseif(\dash\request::post('type') === 'remove')
		{
			$result = \lib\app\cart\remove::from_cart($product_id);
			if($result)
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>
