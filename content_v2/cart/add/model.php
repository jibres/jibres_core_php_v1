<?php
namespace content_v2\cart\add;


class model
{
	public static function post()
	{
		$product = \content_v2\tools::input_body('product');
		$count   = \content_v2\tools::input_body('count');
		$result  = \lib\app\cart\add::new_cart($product, $count);
		\content_v2\tools::say($result);
	}
}
?>