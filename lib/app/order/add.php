<?php
namespace lib\app\order;


class add
{

	/**
	 * add new factor
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function new_factor($_factor, $_factor_detail, $_option = [])
	{
		// store not loaded!
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		$default_option =
		[
			'debug'               => true,

			// fill if in edit mode
			'factor_id'           => null,

			// customer try to add new factor by cart and shipping page
			'customer_mode'       => false,

			// only calculate factor value for show in shipping page
			'only_calculate'      => false,

			// the raw discount code
			// need to check is valid
			// fill discoutn2 on factors
			'discount_code'       => null,
			// in edit mode we have discount id vs discount code
			'discount_id'         => null,

			'start_transaction'   => true,

			// recalculate factor
			're_calculate_factor' => false,

			// force set shipping value by admin
			'force_shipping_value' => null,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		/**
		 * Factor add by customer
		 * from website cart checkout module
		 *
		 * @var        <type>
		 */
		$add_by_customer = $_option['customer_mode'];


		// the factor mode
		$mode = 'admin';

		if($add_by_customer)
		{
			// change factor mode to customer
			$mode = 'customer';
		}

		// need start transaction and then commit or rollback
		$start_transaction = $_option['start_transaction'];

		// in admin module need check permission
		if(!$add_by_customer)
		{
			// check permission to add new factor
			\dash\permission::access('factorSaleAdd');
		}

		// check factor args
		$factor          = \lib\app\order\check::factor($_factor, $_option);

		if(!$factor || !\dash\engine\process::status())
		{
			return false;
		}

		// save factor type to send to check factor detail function
		$_option['type'] = $factor['type'];

		// check factor detail function
		$factor_detail = \lib\app\order\check_detail::factor_detail($_factor_detail, $_option);

		if(!$factor_detail || !\dash\engine\process::status())
		{
			return false;
		}

		// prepare factor field
		$factor['subprice']    = self::my_sum($factor_detail, 'sub_price_temp');
		$factor['subdiscount'] = self::my_sum($factor_detail, 'sub_discount_temp');
		$factor['subvat']      = self::my_sum($factor_detail, 'sub_vat_temp');
		$factor['subtotal']    = self::my_sum($factor_detail, 'sum');
		$factor['qty']         = self::my_sum($factor_detail, 'count');
		$factor['item']        = count($factor_detail);

		/*===========================================
		=            Check discount code            =
		===========================================*/
		$check_discount_code = [];

		// if($_option['discount_code'] || $_option['discount_id'])
		// {
		// 	if($_option['discount_code'])
		// 	{
		// 		$check_discount_code = \lib\app\discount\discount_check::get_result($_option['discount_code'], $factor, $factor_detail);
		// 	}
		// 	else
		// 	{
		// 		$check_discount_code = \lib\app\discount\discount_check::get_result_by_discount_id($_option['discount_id'], $factor, $factor_detail);
		// 	}

		// 	// save discount id
		// 	if(a($check_discount_code, 'discount_id'))
		// 	{
		// 		$factor['discount_id'] = $check_discount_code['discount_id'];
		// 	}
		}
		/*=====  End of Check discount code  ======*/

		// calc discount2 from discount code
		$factor['discount2'] = null;
		if(a($check_discount_code, 'discount2'))
		{
			$factor['discount2'] = $check_discount_code['discount2'];
		}

		// calculate total price
		// temp calculate total to send to shipping function
		$factor['total']     = floatval($factor['subtotal']) - floatval($factor['discount']) - floatval($factor['discount2']);

		// check discount less than total price
		if($factor['discount'])
		{
			if(floatval($factor['discount']) + floatval($factor['discount2']) > floatval($factor['subtotal']))
			{
				\dash\notif::error(T_("Discount is larger than order total"));
				return false;
			}
		}

		// calcuate shipping if in customer mdoe
		if($add_by_customer)
		{
			// check all item of factor detail is file or no
			$fileMode = false;
			if(array_values(array_filter(array_unique(array_column($factor_detail, 'type')))) === ['file'])
			{
				$fileMode = true;
			}

			$factor = shipping::calculate_shipping_value($factor, ['mode' => $mode, 'fileMode' => $fileMode, 'shipping_value' => a($_option, 'force_shipping_value')]);
		}

		$factor['realshipping'] = $factor['shipping'];

		// check discount code is freeshipping mode
		if(a($check_discount_code, 'free_shipping') === true)
		{
			$factor['shipping'] = 0;
		}

		// finaly calculate total by shipping and discount price
		$factor['total']     = (floatval($factor['subtotal']) - (floatval($factor['discount']) + floatval($factor['discount2']))) + floatval($factor['shipping']);

		// check max input size for factor
		$factor          = \lib\app\factor\check::value_max_limit($factor, $_option);

		if(!$factor || !\dash\engine\process::status())
		{
			return false;
		}

		/**
		 * Retrun data.
		 * Only need calculate factor detail
		 */
		if($_option['only_calculate'])
		{
			$factor['discount_code'] = $check_discount_code;
			return $factor;
		}


		if($_option['re_calculate_factor'])
		{
			$result                  = [];
			$result['factor']        = $factor;
			$result['factor_detail'] = $factor_detail;
			$result['discount_code'] = $check_discount_code;
			return $result;
		}


		$ip_id    = \dash\utility\ip::id();
		$agent_id = \dash\agent::get(true);
		// needless to recalculate field.
		// this field only use in add new factor
		// according to this set after return re_calculate_factor option
		$factor['status']    = $factor['status'] ? $factor['status'] : 'registered';
		$factor['seller']    = \dash\user::id();
		$factor['date']      = date("Y-m-d H:i:s");
		$factor['title']     = null;
		$factor['pre']       = null;
		$factor['desc']      = $factor['desc'];
		$factor['mode']      = $mode;
		$factor['ip_id']    = $ip_id;
		$factor['agent_id'] = $agent_id;


		// only in customer mode check minimum order amount
		// admin can add order by every amount
		if($add_by_customer)
		{
			if(!self::check_minimum_cart_setting($factor['subtotal']))
			{
				return false;
			}

			// check rate limit add new order
			if(!self::check_rate_limit($factor['customer'], $ip_id, $agent_id))
			{
				return false;
			}
		}


		/*=============================================
		=            Add new factor record            =
		=============================================*/
		if($start_transaction)
		{
			// start transaction of db
			\dash\pdo::transaction();
		}

		if(!$_option['factor_id'])
		{
			$add_new_factor = true;
			$factor_id = \lib\db\orders\insert::new_record($factor);
		}
		else
		{
			$add_new_factor = false;
			$factor_id = $_option['factor_id'];
		}


		if(!$factor_id)
		{
			\dash\log::set('factor:no:way:to:insert:factor');
			\dash\notif::error(T_("No way to insert factor"));

			if($start_transaction)
			{
				\dash\pdo::rollback();
			}

			return false;
		}
		/*=====  End of Add new factor record  ======*/



		/*==========================================
		=            Save factor detail            =
		==========================================*/
		$product_discount = [];
		if(is_array(a($check_discount_code, 'product_discount')))
		{
			$product_discount = $check_discount_code['product_discount'];
		}

		$product_need_track_stock = [];

		foreach ($factor_detail as $key => $value)
		{
			$factor_detail[$key]['factor_id'] = $factor_id;
			unset($factor_detail[$key]['sub_price_temp']);
			unset($factor_detail[$key]['sub_discount_temp']);
			unset($factor_detail[$key]['sub_vat_temp']);
			unset($factor_detail[$key]['type']);

			if($value['track_stock_temp'])
			{
				$product_need_track_stock[] = $value;
			}

			// save product discount
			if(isset($product_discount[$value['product_id']]))
			{
				$factor_detail[$key]['discount2'] = $product_discount[$value['product_id']];

			}

			unset($factor_detail[$key]['track_stock_temp']);

		}

		// insert factor detail record
		$add_detail = \lib\db\orderdetails\insert::multi_insert($factor_detail);

		if(!$add_detail)
		{
			if($start_transaction)
			{
				\dash\pdo::rollback();
			}
			return false;
		}

		// save product inventory
		foreach ($product_need_track_stock as $key => $value)
		{
			\lib\app\product\inventory::set('sale', $value['count'], $value['product_id'], $factor_id);
			$get_stock = \lib\app\product\inventory::get($value['product_id']);
			if(!is_null($get_stock))
			{
				if($get_stock <= 0)
				{
					\lib\app\product\edit::out_of_stock($value['product_id']);
				}
			}
		}
		/*=====  End of Save factor detail  ======*/


		// finaly notif and commit

		if(\dash\engine\process::status())
		{
			if($start_transaction)
			{
				\dash\pdo::commit();
			}

			$msg = T_("Factor successfuly added");

			if(!$add_by_customer)
			{
				$msg = '<a href="'. \dash\url::kingdom(). '/a/order/detail?id='. $factor_id. '">'. $msg . '</a>';
			}

			\dash\notif::ok($msg);
		}

		// return result
		$return              = [];
		$return['factor_id'] = $factor_id;
		$return['price']     = floatval($factor['total']);

		return $return;
	}


	/**
	 * My array_sum
	 *
	 * @param      <type>  $_array   The array
	 * @param      <type>  $_column  The column
	 *
	 * @return     int     ( description_of_the_return_value )
	 */
	public static function my_sum($_array, $_column)
	{
		$sum = 0;

		if(is_array($_array))
		{
			foreach ($_array as $key => $value)
			{
				if(isset($value[$_column]))
				{
					$sum += floatval($value[$_column]);
				}
			}
		}

		return $sum;
	}



	private static function check_rate_limit($_customer, $_ip_id, $_agent_id)
	{
		$until = date("Y-m-d H:i:s", (time() - (60*60)));

		if(isset($_customer) && is_numeric($_customer))
		{
			$count_factor_record_per_user = \lib\db\factors\get::count_factor_record_per_user($_customer, $until);

			if($count_factor_record_per_user > 20)
			{
				\dash\notif::error(T_("You have a lot unpaid factors. Please try again later"));

				\dash\waf\ip::isolateIP(1, 'user max factor unpaid 1 hour');

                return false;
			}
		}
		else
		{
			if(!$_ip_id || !$_agent_id)
			{
				\dash\notif::error(T_("Who are you?"));

				\dash\waf\ip::isolateIP(1, 'factor ip or agent id is null!');

	            return false;
			}

			$count_factor_record_per_ip = \lib\db\factors\get::count_factor_record_per_ip($_ip_id, $until);

			if($count_factor_record_per_ip > 10)
			{
				\dash\notif::error(T_("You have a lot unpaid factors. Please try again later or login to add more"));

				\dash\waf\ip::isolateIP(1, 'ip max factor unpaid 1 hour');

                return false;
			}
			else
			{
				$count_factor_record_per_ip_agent = \lib\db\factors\get::count_factor_record_per_ip_agent($_ip_id, $_agent_id, $until);

				if($count_factor_record_per_ip_agent > 5)
				{
					\dash\notif::error(T_("You have a lot unpaid factors. Please try again later or login to add more"));

					\dash\waf\ip::isolateIP(1, 'ip agent max factor unpaid 1 hour');

					return false;
				}
			}

		}

		// ok
		return true;
	}


	private static function check_minimum_cart_setting($_subtotal)
	{
		$cart_setting = \lib\app\setting\get::cart_setting();
		if(isset($cart_setting['minimumorderamount']) && $cart_setting['minimumorderamount'] && is_numeric($cart_setting['minimumorderamount']))
		{
			if(floatval($_subtotal) < floatval($cart_setting['minimumorderamount']))
			{
				$minimumorderamount_html = T_("Minimum order amount is :val :currency", ['val' => \dash\fit::number($cart_setting['minimumorderamount']), 'currency' => \lib\store::currency()]);
				$minimumorderamount_html .= '<br>';
				$minimumorderamount_html .= T_("You must add :val :currency to your cart", ['val' => \dash\fit::number($cart_setting['minimumorderamount'] - $_subtotal), 'currency' => \lib\store::currency()]);
				\dash\notif::error('1', ['alerty' => true, 'html' => $minimumorderamount_html]);
				return false;
			}
		}

		return true;
	}
}
?>