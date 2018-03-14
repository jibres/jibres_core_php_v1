<?php
namespace content_a\factor\edit;


class model extends \content_a\main\model
{
	/**
	 * Gets the post factor product.
	 *
	 * @return     array|boolean  The post factor product.
	 */
	public static function getPostSaleProduct()
	{
		$product  = \lib\utility::post('products');
		$count    = \lib\utility::post('count');
		$discount = \lib\utility::post('discount');

		if(!is_array($product) || !is_array($count) || !is_array($discount))
		{
			\lib\debug::error(T_("What are you doing?"));
			return false;
		}

		$product  = array_values($product);
		$count    = array_values($count);
		$discount = array_values($discount);

		$factor_list = [];

		foreach ($product as $key => $value)
		{
			$factor_list[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
				'discount' => array_key_exists($key, $discount) ? $discount[$key] : null,
			];
		}

		return $factor_list;
	}


	/**
	 * Gets the post factor detail.
	 *
	 * @return     array  The post factor detail.
	 */
	public static function getPostSaleDetail()
	{
		$detail             = [];
		$detail['customer'] = \lib\utility::post('customer');
		$detail['desc']     = \lib\utility::post('desc');
		return $detail;
	}


	/**
	 * Posts a factor edit.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public function post_factor_edit()
	{
		// ready factor_list
		$factor_list = self::getPostSaleProduct();

		if($factor_list === false)
		{
			return false;
		}

		// ready factor_list
		$detail = self::getPostSaleDetail();

		if($detail === false)
		{
			return false;
		}

		\lib\app\factor::edit(\lib\utility::get('id'), $detail, $factor_list);

		if(\lib\debug::$status)
		{
			$this->redirector(\lib\url::base(). '/a/factor');
		}
	}
}
?>
