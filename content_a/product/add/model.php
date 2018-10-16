<?php
namespace content_a\product\add;


class model
{
	public static function getPost()
	{
		$args =
		[
			'title'    => \dash\request::post('title'),
			'cat'      => \dash\request::post('cat'),
			'unit'     => \dash\request::post('unit'),
			'barcode'  => \dash\request::post('barcode'),
			'barcode2' => \dash\request::post('barcode2'),
			'buyprice' => \dash\request::post('buyprice'),
			'price'    => \dash\request::post('price'),
			'discount' => \dash\request::post('discount'),
		];

		return $args;
	}


	public static function post()
	{
		\lib\app\product::add(self::getPost());

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here(). '/product');
		}
	}
}
?>
