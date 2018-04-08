<?php
namespace content_a\product\add;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$args =
		[
			'title'          => \dash\request::post('title'),
			'code'            => \dash\request::post('code'),

			'cat'            => \dash\request::post('cat'),
			'company'        => \dash\request::post('company'),

			'unit'           => \dash\request::post('unit'),
			'carton'         => \dash\request::post('carton'),

			'barcode'        => \dash\request::post('barcode'),
			'barcode2'       => \dash\request::post('barcode2'),

			'minstock'       => \dash\request::post('minstock'),
			'maxstock'       => \dash\request::post('maxstock'),

			'buyprice'       => \dash\request::post('buyprice'),
			'price'          => \dash\request::post('price'),
			'discount'       => \dash\request::post('discount'),

			'initialbalance' => \dash\request::post('initialbalance'),
			'status'         => \dash\request::post('status'),
		];

		return $args;
	}


	public function post_add($_args)
	{
		\lib\app\product::add(self::getPost());

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here(). '/product');
		}

	}
}
?>
