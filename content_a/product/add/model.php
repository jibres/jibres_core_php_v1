<?php
namespace content_a\product\add;
use \lib\utility;
use \lib\debug;

class model extends \content_a\main\model
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
			'title'          => utility::post('title'),
			'name'           => utility::post('name'),
			'cat'            => utility::post('cat'),
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
	public function post_add($_args)
	{
		\lib\app\product::add(self::getPost());

		if(debug::$status)
		{
			$this->redirector($this->url('baseFull'). '/product');
		}

	}
}
?>