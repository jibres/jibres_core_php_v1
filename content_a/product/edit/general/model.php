<?php
namespace content_a\product\edit\general;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$args =
		[
			'title'          => \lib\request::post('title'),
			'name'           => \lib\request::post('name'),
			'code'           => \lib\request::post('code'),
			'cat'            => \lib\request::post('cat'),
			'slug'           => \lib\request::post('slug'),
			'company'        => \lib\request::post('company'),
			'shortcode'      => \lib\request::post('shortcode'),
			'unit'           => \lib\request::post('unit'),
			'barcode'        => \lib\request::post('barcode'),
			'barcode2'       => \lib\request::post('barcode2'),
			'buyprice'       => \lib\request::post('buyprice'),
			'price'          => \lib\request::post('price'),
			'discount'       => \lib\request::post('discount'),
			'vat'            => \lib\request::post('vat'),
			'initialbalance' => \lib\request::post('initialbalance'),
			'minstock'       => \lib\request::post('minstock'),
			'maxstock'       => \lib\request::post('maxstock'),
			'status'         => \lib\request::post('status'),
			'sold'           => \lib\request::post('sold'),
			'stock'          => \lib\request::post('stock'),
			'service'        => \lib\request::post('service') === 'on' ? 1 : 0,
			'saleonline'     => \lib\request::post('saleonline') === 'on' ? 1 : 0,
			'salestore'      => \lib\request::post('salestore') === 'on' ? 1 : 0,
			'carton'         => \lib\request::post('carton'),
		];

		return $args;
	}


	public function post_general($_args)
	{

		$request         = self::getPost();
		$request['id']   = \lib\request::get('id');

		\lib\app\product::edit($request);

		if(\lib\debug::$status)
		{
			// $this->redirector(\lib\url::pwd());
			// after save redirect to list of products
			$url_of_product_list = \lib\url::here().'/product';
			$this->redirector($url_of_product_list);
		}
	}
}
?>
