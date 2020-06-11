<?php
namespace content_a\cart\add;

class model
{
	public static function post()
	{
		$cart_list = self::getCartProduct();

		if($cart_list === false)
		{
			return false;
		}

		$detail = self::getCartDetail();

		\lib\app\cart\add::admin_add($cart_list, $detail);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}


	/**
	 * Gets the post cart product.
	 *
	 * @return     array|boolean  The post cart product.
	 */
	public static function getCartProduct()
	{
		if(empty(array_filter(\dash\request::post())))
		{
			\dash\notif::warn(T_("No items have been added for cart"));
			return false;
		}

		$product  = \dash\request::post('products');
		$count    = \dash\request::post('count');

		if(!is_array($product) || !is_array($count))
		{
			\dash\notif::warn(T_("No items have been added for cart"));
			return false;
		}

		$product  = array_values($product);
		$count    = array_values($count);

		$cart_list = [];

		foreach ($product as $key => $value)
		{
			$cart_list[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
			];
		}

		return $cart_list;
	}


	/**
	 * Gets the post cart detail.
	 *
	 * @return     array  The post cart detail.
	 */
	public static function getCartDetail()
	{
		$detail                = [];
		$detail['customer']    = \dash\request::post('customer');
		$detail['mobile']      = \dash\request::post('memberTl');
		$detail['gender']      = \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null;
		$detail['displayname'] = \dash\request::post('memberN');

		return $detail;
	}
}
?>
