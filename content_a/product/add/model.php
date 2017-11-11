<?php
namespace content_a\product\add;


class model extends \content_a\main\model
{
	public static function getPost()
	{

		$args =
		[
			'title'          => \lib\utility::post('title'),

			'cat'            => \lib\utility::post('cat'),
			'company'        => \lib\utility::post('company'),

			'unit'           => \lib\utility::post('unit'),
			'carton'         => \lib\utility::post('carton'),

			'barcode'        => \lib\utility::post('barcode'),
			'barcode2'       => \lib\utility::post('barcode2'),

			'minstock'       => \lib\utility::post('minstock'),
			'maxstock'       => \lib\utility::post('maxstock'),

			'buyprice'       => \lib\utility::post('buyprice'),
			'price'          => \lib\utility::post('price'),
			'discount'       => \lib\utility::post('discount'),

			'initialbalance' => \lib\utility::post('initialbalance'),
			'status'         => \lib\utility::post('status'),
		];

		return $args;
	}


	public function post_add($_args)
	{
		\lib\app\product::add(self::getPost());

		if(\lib\debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/product');
		}

	}
}
?>
