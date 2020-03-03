<?php
namespace content_v2\cart\delete;


class model
{

	public static function delete()
	{
		$product = \content_v2\tools::input_body('product');
		$result  = \lib\app\cart\remove::from_cart($product);
		\content_v2\tools::say($result);
	}



}
?>