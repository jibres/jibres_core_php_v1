<?php
namespace content_v2\cart\edit;


class model
{
	public static function put()
	{
		$product = \content_v2\tools::input_body('product');
		$count   = \content_v2\tools::input_body('count');
		$result  = \lib\app\cart\edit::update_cart($product, $count);
		\content_v2\tools::say($result);
	}
}
?>