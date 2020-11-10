<?php
namespace content_a\order\products;


class model
{
	public static function post()
	{
		$factor_id               = \dash\request::get('id');
		$product          = \dash\request::post('product_id');
		$count            = \dash\request::post('count');
		$type             = \dash\request::post('type');
		$factor_detail_id = \dash\request::post('factor_detail_id');

		if($type === 'edit_count' || $type === 'plus_count' || $type === 'minus_count')
		{
			\lib\app\factor\edit::edit_count_product($factor_detail_id, $factor_id, $type, $count);
		}
		elseif(\dash\request::post('type') === 'remove')
		{
			\lib\app\factor\remove::remove_product($factor_detail_id, $factor_id, $product);
		}
		else
		{
			$post               = [];
			$post['product_id'] = $product_id;
			$post['count']      = $count;
			$post['price']      = $price;
			$post['discount']   = $discount;
			$post['addanother'] = $addanother;


			\lib\app\factor\add::add_product($post, $factor_id);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
