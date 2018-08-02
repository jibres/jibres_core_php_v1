<?php
namespace content_a\product\warehouse;


class model
{
	public static function getPost()
	{
		$args =
		[
			// 'title'          => \dash\request::post('title'),
			// 'cat'            => \dash\request::post('cat'),
			// 'unit'           => \dash\request::post('unit'),
			// 'code'           => \dash\request::post('code'),
			// 'barcode'        => \dash\request::post('barcode'),
			// 'barcode2'       => \dash\request::post('barcode2'),
			// 'buyprice'       => \dash\request::post('buyprice'),
			// 'price'          => \dash\request::post('price'),
			// 'discount'       => \dash\request::post('discount'),

			'company'        => \dash\request::post('company'),
			'carton'         => \dash\request::post('carton'),
			'initialbalance' => \dash\request::post('initialbalance'),
			'minstock'       => \dash\request::post('minstock'),
			'maxstock'       => \dash\request::post('maxstock'),
			'status'         => \dash\request::post('status'),

			// 'name'           => \dash\request::post('name'),
			// 'slug'           => \dash\request::post('slug'),
			// 'shortcode'      => \dash\request::post('shortcode'),
			// 'vat'            => \dash\request::post('vat'),
			// 'sold'           => \dash\request::post('sold'),
			// 'stock'          => \dash\request::post('stock'),
			// 'service'        => \dash\request::post('service') === 'on' ? 1 : 0,
			// 'saleonline'     => \dash\request::post('saleonline') === 'on' ? 1 : 0,
			// 'salestore'      => \dash\request::post('salestore') === 'on' ? 1 : 0,
		];
		return $args;
	}


	public static function post()
	{
		\dash\permission::access('aProductEdit');
		$request         = self::getPost();
		$request['id']   = \dash\request::get('id');

		\lib\app\product::edit($request);

		if(\dash\engine\process::status())
		{
			// \dash\redirect::pwd();
			// after save redirect to list of products
			$url_of_product_list = \dash\url::here().'/product';
			\dash\redirect::to($url_of_product_list);
		}
	}
}
?>
