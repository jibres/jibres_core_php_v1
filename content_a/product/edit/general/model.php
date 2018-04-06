<?php
namespace content_a\product\edit\general;


class model extends \content_a\main\model
{
	public static function getPost()
	{
		$args =
		[
			'title'          => \dash\request::post('title'),
			'name'           => \dash\request::post('name'),
			'code'           => \dash\request::post('code'),
			'cat'            => \dash\request::post('cat'),
			'slug'           => \dash\request::post('slug'),
			'company'        => \dash\request::post('company'),
			'shortcode'      => \dash\request::post('shortcode'),
			'unit'           => \dash\request::post('unit'),
			'barcode'        => \dash\request::post('barcode'),
			'barcode2'       => \dash\request::post('barcode2'),
			'buyprice'       => \dash\request::post('buyprice'),
			'price'          => \dash\request::post('price'),
			'discount'       => \dash\request::post('discount'),
			'vat'            => \dash\request::post('vat'),
			'initialbalance' => \dash\request::post('initialbalance'),
			'minstock'       => \dash\request::post('minstock'),
			'maxstock'       => \dash\request::post('maxstock'),
			'status'         => \dash\request::post('status'),
			'sold'           => \dash\request::post('sold'),
			'stock'          => \dash\request::post('stock'),
			'service'        => \dash\request::post('service') === 'on' ? 1 : 0,
			'saleonline'     => \dash\request::post('saleonline') === 'on' ? 1 : 0,
			'salestore'      => \dash\request::post('salestore') === 'on' ? 1 : 0,
			'carton'         => \dash\request::post('carton'),
		];

		return $args;
	}


	public function post_general($_args)
	{

		$request         = self::getPost();
		$request['id']   = \dash\request::get('id');

		\lib\app\product::edit($request);

		if(\lib\engine\process::status())
		{
			// \lib\redirect::pwd();
			// after save redirect to list of products
			$url_of_product_list = \dash\url::here().'/product';
			\lib\redirect::to($url_of_product_list);
		}
	}
}
?>
