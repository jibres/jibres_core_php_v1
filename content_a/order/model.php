<?php
namespace content_a\order;


class model
{
	public static function post()
	{
		$factor_list = self::getPostSaleProduct();

		if($factor_list === false)
		{
			return false;
		}

		$detail = self::getPostSaleDetail();

		$factor_detail = \lib\app\factor\add::new_factor($detail, $factor_list);

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
	public static function getPostSaleProduct()
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
