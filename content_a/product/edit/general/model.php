<?php
namespace content_a\product\edit\general;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$args =
		[
			'title'          => \lib\utility::post('title'),
			'name'           => \lib\utility::post('name'),
			'code'           => \lib\utility::post('code'),
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


	public function post_general($_args)
	{

		$request         = self::getPost();
		$request['id']   = \lib\utility::get('id');

		\lib\app\product::edit($request);

		if(\lib\debug::$status)
		{
			// $this->redirector($this->url('full'));
			// after save redirect to list of products
			$url_of_product_list = $this->url('baseFull').'/product';
			$this->redirector($url_of_product_list);
		}
	}
}
?>
