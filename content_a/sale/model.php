<?php
namespace content_a\sale;


class model
{
	public static function post()
	{
		$order_items = self::order_items();

		if($order_items === false)
		{
			return false;
		}

		$detail = self::get_order_detail();

		$factor_detail = \lib\app\factor\add::new_factor($detail, $order_items);

		$query_data = [];

		if(\dash\engine\process::status())
		{
			// @new
			// if(isset($factor_detail['factor_id']))
			// {
			// 	// $query_data['print'] = 'auto';
			// 	// $query_data['size']  = 'receipt8';
			// 	$query_data['id']    = $factor_detail['factor_id'];
			// 	$redirect_url        = \dash\url::this(). '/opr';
			// }
			// else
			// {
			// 	$redirect_url = \dash\url::this();
			// }


			if(isset($factor_detail['factor_id']))
			{

				if(\dash\request::post('save_btn') === 'save_next')
				{
					$query_data['type']  = \dash\request::get('type');
					$redirect_url        = \dash\url::this();

				}
				elseif(\dash\request::post('save_btn') === 'save_print')
				{
					$query_data['id']    = $factor_detail['factor_id'];
					$query_data['print'] = 'auto';
					// $redirect_url        = \dash\url::here(). '/chap/receipt';
					$redirect_url        = \dash\url::here(). '/chap';

				}
				else
				{
					\dash\notif::error(T_("Dont!"));
					return false;
				}
			}
			else
			{
				$redirect_url = \dash\url::this();
			}

			if(!empty($query_data))
			{
				$redirect_url .= '?'. http_build_query($query_data);
			}

			\dash\redirect::to($redirect_url);
		}
	}


	/**
	 * Gets the post factor product.
	 *
	 * @return     array|boolean  The post factor product.
	 */
	public static function order_items()
	{
		if(empty(array_filter(\dash\request::post())))
		{
			\dash\notif::warn(T_("No items have been added for sale"));
			return false;
		}

		$product  = \dash\request::post('products');
		$count    = \dash\request::post('count');
		$discount = \dash\request::post('discount');

		if(!is_array($product) || !is_array($count) || !is_array($discount))
		{
			\dash\notif::warn(T_("No items have been added for sale"));
			return false;
		}

		$product  = array_values($product);
		$count    = array_values($count);
		$discount = array_values($discount);

		$order_items = [];

		foreach ($product as $key => $value)
		{
			$my_discount = null;

			if(array_key_exists($key, $discount))
			{
				if($discount[$key])
				{
					$my_discount = $discount[$key];
				}
				else
				{
					$my_discount = 0;
				}
			}

			$order_items[] =
			[
				'product'  => $value,
				'count'    => array_key_exists($key, $count) ? $count[$key] : null,
				'discount' => $my_discount,
				'price'    => null, // get from product price
			];
		}

		return $order_items;
	}


	/**
	 * Gets the post factor detail.
	 *
	 * @return     array  The post factor detail.
	 */
	public static function get_order_detail()
	{
		$detail                = [];
		$detail['customer']    = \dash\request::post('customer');
		$detail['mobile']      = \dash\request::post('memberTl');
		$detail['gender']      = \dash\request::post('memberGender') ? \dash\request::post('memberGender') : null;
		$detail['displayname'] = \dash\request::post('memberN');

		$detail['type']     = 'sale';
		$detail['desc']     = \dash\request::post('desc');
		return $detail;
	}
}
?>
