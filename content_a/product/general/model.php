<?php
namespace content_a\product\general;


class model
{
	public static function getPost()
	{
		$args =
		[
			'title'    => \dash\request::post('title'),
			'cat'      => \dash\request::post('cat'),
			'unit'     => \dash\request::post('unit'),
			'code'     => \dash\request::post('code'),
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
		$request         = self::getPost();

		\lib\app\product::edit($request, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			// @check
			\dash\redirect::pwd();

			// after save redirect to list of products
			$url_of_product_list = \dash\url::here().'/product';
			\dash\redirect::to($url_of_product_list);
		}
	}
}
?>
