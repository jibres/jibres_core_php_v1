<?php
namespace content_a\product\add;


class model extends \content_a\main\model
{
	public static function getPost()
	{

		$args =
		[
			'title'          => \lib\utility::post('title'),
			'name'           => \lib\utility::post('name'),
			'cat'            => \lib\utility::post('cat'),
			'slug'           => \lib\utility::post('slug'),
			'company'        => \lib\utility::post('company'),
			'shortcode'      => \lib\utility::post('shortcode'),
			'unit'           => \lib\utility::post('unit'),
			'barcode'        => \lib\utility::post('barcode'),
			'barcode2'       => \lib\utility::post('barcode2'),
			'buyprice'       => \lib\utility::post('buyprice'),
			'price'          => \lib\utility::post('price'),
			'discount'       => \lib\utility::post('discount'),
			'vat'            => \lib\utility::post('vat'),
			'initialbalance' => \lib\utility::post('initialbalance'),
			'minstock'       => \lib\utility::post('minstock'),
			'maxstock'       => \lib\utility::post('maxstock'),
			'status'         => \lib\utility::post('status'),
			'sold'           => \lib\utility::post('sold'),
			'stock'          => \lib\utility::post('stock'),
			'service'        => \lib\utility::post('service') === 'on' ? 1 : 0,
			'sellonline'     => \lib\utility::post('sellonline') === 'on' ? 1 : 0,
			'sellstore'      => \lib\utility::post('sellstore') === 'on' ? 1 : 0,
			'carton'         => \lib\utility::post('carton'),
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
