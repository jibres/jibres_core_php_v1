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
		$product  = \dash\request::post('products');
		$count    = \dash\request::post('count');
		$discount = \dash\request::post('discount');

		if(!is_array($product) || !is_array($count) || !is_array($discount))
		{
			\dash\notif::error(T_("What are you doing?"));
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
		$detail['customer'] = \dash\request::post('customer');
		$detail['desc']     = \dash\request::post('desc');
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

		\lib\app\factor::edit(\dash\request::get('id'), $detail, $factor_list);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::base(). '/a/factor');
		}
	}
}
?>
