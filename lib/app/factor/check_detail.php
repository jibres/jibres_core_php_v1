<?php
namespace lib\app\factor;


class check_detail
{



	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor_detail($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$list    = \dash\app::request();

		$decode_list   = [];
		$allproduct_id = [];
		$trust_order_list      = [];

		$have_warn     = [];

		foreach ($list as $key => $value)
		{
			$product_id = null;
			if(isset($value['product']))
			{
				$product_id = $value['product'];
			}

			if(!$product_id)
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(!array_key_exists('count', $value))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			$value['count'] = \dash\number::clean($value['count']);

			if(!is_numeric($value['count']))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(floatval($value['count']) == 0)
			{
				$have_warn[] = $key + 1;
				continue;
			}


			/**
			 * @CHECK @REZA
			 * Need to get from store or set manually
			 */
			$maxproductcount = 9999;

			if($maxproductcount && floatval($value['count']) > floatval($maxproductcount))
			{
				\dash\notif::error(T_("The maximum count product in factor in your store is :val", ['val' => \dash\utility\human::fitNumber($maxproductcount)]), $key + 1);
				return false;
			}

			// up count to remove desimal
			$value['count'] = \lib\number::up($value['count']);

			$continue = false;

			switch ($_option['type'])
			{
				case 'sale':
					if(isset($value['discount']) && $value['discount'] &&  !is_numeric($value['discount']))
					{
						$have_warn[] = $key + 1;
						$continue    = true;
						break;
					}
					break;

				case 'buy':
				case 'prefactor':
				case 'lending':
				case 'backbuy':
				case 'backfactor':
				case 'waste':
				default:
					\dash\notif::error(T_("Invalid factor type"), 'type');
					return false;
					break;
			}

			if($continue)
			{
				continue;
			}

			if(isset($value['discount']))
			{
				$value['discount'] = \lib\price::up($value['discount']);
			}

			$trust_order_list[$key]['count']      = floatval($value['count']);
			$trust_order_list[$key]['discount']   = (isset($value['discount'])) ? intval($value['discount']) : null;
			$trust_order_list[$key]['product_id'] = $product_id;

			$allproduct_id[]              = $product_id;
		}

		if(count($allproduct_id) <> count(array_unique($allproduct_id)))
		{
			\dash\notif::error(T_("Duplicate product in one factor founded"));
			return false;
		}

		$allproduct_id      = array_unique($allproduct_id);

		if(empty($allproduct_id))
		{
			\dash\notif::error(T_("No valid products found in your list"));
			return false;
		}


		if(!empty($have_warn))
		{
			\dash\notif::warn(T_("Invalid product detail in some record of this factor, [:key]", ['key' => implode(',', $have_warn)]));
		}


		$check_true_product = \lib\db\products\get::by_multi_id(implode(',', $allproduct_id));
		$true_product_ids   = array_column($check_true_product, 'id');
		$check_true_product = array_combine($true_product_ids, $check_true_product);

		$factor_detail = [];

		foreach ($trust_order_list as $key => $value)
		{
			$factor_detail_record = [];

			if(!isset($check_true_product[$value['product_id']]))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			$this_proudct = $check_true_product[$value['product_id']];

			$count      = floatval($value['count']);
			$price      = 0;
			$finalprice = 0;
			$discount   = 0;
			$vatprice   = 0;

			switch ($_option['type'])
			{
				case 'sale':


					if(!array_key_exists('discount', $this_proudct))
					{
						\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
						return false;
					}

					$factor_detail_record['discount'] = $value['discount'] === null ? $this_proudct['discount'] : $value['discount'];

					$discount                         = floatval($factor_detail_record['discount']);
					$price                            = floatval($this_proudct['price']);
					$finalprice                       = floatval($this_proudct['finalprice']);
					$vatprice                         = floatval($this_proudct['vatprice']);


					$factor_detail_record['sum']               = $finalprice * $count;
					$factor_detail_record['vat']               = $vatprice;
					$factor_detail_record['sum_vat_temp']      = $vatprice * $count;
					$factor_detail_record['sum_price_temp']    = $price * $count;
					$factor_detail_record['sum_discount_temp'] = $discount * $count;
					break;

				case 'buy':
				case 'prefactor':
				case 'lending':
				case 'backbuy':
				case 'backfactor':
				case 'waste':

					break;
			}

			$factor_detail_record['product_id'] = $value['product_id'];
			$factor_detail_record['price']      = $finalprice;
			$factor_detail_record['count']      = $value['count'] === null ? 1 : $count;

			$factor_detail[] = $factor_detail_record;
		}

		return $factor_detail;
	}
}
?>