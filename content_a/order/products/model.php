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

		if($type === 'edit_count' || $type === 'plus_count' || $type === 'minus_count' || $type === 'remove')
		{
			\lib\app\factor\edit::edit_count_product($factor_detail_id, $factor_id, $type, $count);
		}
		else
		{
			$post               = [];
			$post['product_id'] = $product;
			$post['count']      = $count;
			$post['price']      = \dash\request::post('price');
			$post['discount']   = \dash\request::post('discount');
			$post['addanother'] = \dash\request::post('addanother');


			\lib\app\factor\add::add_product($post, $factor_id);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>
