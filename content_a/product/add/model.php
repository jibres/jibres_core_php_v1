<?php
namespace content_a\product\add;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$args =
		[
			'title'          => \lib\request::post('title'),
			'code'            => \lib\request::post('code'),

			'cat'            => \lib\request::post('cat'),
			'company'        => \lib\request::post('company'),

			'unit'           => \lib\request::post('unit'),
			'carton'         => \lib\request::post('carton'),

			'barcode'        => \lib\request::post('barcode'),
			'barcode2'       => \lib\request::post('barcode2'),

			'minstock'       => \lib\request::post('minstock'),
			'maxstock'       => \lib\request::post('maxstock'),

			'buyprice'       => \lib\request::post('buyprice'),
			'price'          => \lib\request::post('price'),
			'discount'       => \lib\request::post('discount'),

			'initialbalance' => \lib\request::post('initialbalance'),
			'status'         => \lib\request::post('status'),
		];

		return $args;
	}


	public function post_add($_args)
	{
		\lib\app\product::add(self::getPost());

		if(\lib\notif::$status)
		{
			\lib\redirect::to(\lib\url::here(). '/product');
		}

	}
}
?>
