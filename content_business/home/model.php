<?php
namespace content_business\home;

class model
{
	public static function post()
	{
		if(\dash\request::post('cart') === 'add')
		{
			$result = \lib\app\cart\add::new_cart_website(\dash\request::post('product_id'), \dash\request::post('count'));
			if($result)
			{
				\dash\redirect::to(\dash\url::kingdom(). '/p/'. \dash\request::post('product_id'));
			}

		}

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