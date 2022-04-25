<?php
namespace content_a\sale;


class model
{
	public static function post()
	{
		if(\dash\request::post('setkeyboard') === 'yes')
		{
			return self::set_sale_page_keyboard();
		}


		$order_items = self::order_items();

		if($order_items === false)
		{
			return false;
		}

		$detail = self::get_order_detail();

		$factor_detail = \lib\app\order\add::new_factor($detail, $order_items);

		$query_data = [];

		if(\dash\engine\process::status())
		{

			if(isset($factor_detail['factor_id']) && \dash\data::moduleType() === 'buy')
			{
				$query_data['id']    = $factor_detail['factor_id'];
				$redirect_url        = \dash\url::this(). '/opr?'. \dash\request::build_query($query_data);
				\dash\redirect::to($redirect_url);
				return;
			}



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

					if(\lib\store::detail('factorautoprint') !== 'no')
					{
						$query_data['print'] = 'auto';
					}

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
			\dash\notif::error(T_("No items have been added"));
			return false;
		}

		$product  = \dash\request::post('products');
		$count    = \dash\request::post('count');
		$discount = \dash\request::post('discount');
		$price    = \dash\request::post('price');

		if(!is_array($price))
		{
			$price = [];
		}

		if(!is_array($discount))
		{
			$discount = [];
		}

		if(!is_array($product) || !is_array($count) || !is_array($discount))
		{
			\dash\notif::error(T_("No items have been added"));
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
				'price'    => array_key_exists($key, $price) ? $price[$key] : null,
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
		$detail['paystatus']   = \dash\request::post('paystatus');

		$detail['type']        = \dash\data::moduleType();
		$detail['desc']        = \dash\request::post('desc');
		return $detail;
	}


	private static function set_sale_page_keyboard()
	{

		$keyboard_status = \lib\app\setting\get::quick_get('sale_page', 'on_screen_kerboard');

		if($keyboard_status === 'yes')
		{
			\lib\app\setting\set::quick_set('sale_page', 'on_screen_kerboard', 'no');
			\dash\notif::tada('#salePageScreenKeyboard', '<div id="salePageScreenKeyboard"></div>', true);
		}
		else
		{
			\lib\app\setting\set::quick_set('sale_page', 'on_screen_kerboard', 'yes');
			\dash\notif::tada('#salePageScreenKeyboard', '<div id="salePageScreenKeyboard">'. view::keyboard_html(''). '</div>', true);
		}

		\dash\notif::complete();

	}
}
?>
