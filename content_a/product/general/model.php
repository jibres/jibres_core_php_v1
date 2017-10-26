<?php
namespace content_a\product\general;
use \lib\utility;
use \lib\debug;

class model extends \content_a\product\model
{

	/**
	 * Gets the post.
	 *
	 * @return     array  The post.
	 */
	public static function getPost()
	{

		$args =
		[
			'title'        => utility::post('title'),
			'name'           => utility::post('name'),
			'slug'           => utility::post('slug'),
			'company'        => utility::post('company'),
			'shortcode'      => utility::post('shortcode'),
			'unit'           => utility::post('unit'),
			'barcode'        => utility::post('barcode'),
			'barcode2'       => utility::post('barcode2'),
			'buyprice'       => utility::post('buyprice'),
			'price'          => utility::post('price'),
			'discount'       => utility::post('discount'),
			'vat'            => utility::post('vat'),
			'initialbalance' => utility::post('initialbalance'),
			'minstock'       => utility::post('minstock'),
			'maxstock'       => utility::post('maxstock'),
			'status'         => utility::post('status'),
			'sold'           => utility::post('sold'),
			'stock'          => utility::post('stock'),
			'service'        => utility::post('service') === 'on' ? 1 : 0,
			'sellonline'     => utility::post('sellonline') === 'on' ? 1 : 0,
			'sellstore'      => utility::post('sellstore') === 'on' ? 1 : 0,
			'carton'         => utility::post('carton'),
		];

		return $args;
	}





	/**
	 * Posts an addproduct.
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public function post_general($_args)
	{

		$request         = self::getPost();
		$product         = \lib\router::get_url(2);
		$request['id']   = $product;

		\lib\app\product::edit($request);

		if(debug::$status)
		{
			$this->redirector($this->url('full'));
		}
	}
}
?>