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

			if(!is_numeric($product_id))
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
				\dash\notif::error(T_("The maximum count product in factor in your store is :val", ['val' => \dash\fit::number($maxproductcount)]), $key + 1);
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
			if(!isset($check_true_product[$value['product_id']]))
			{
				continue;
			}

			$this_proudct = $check_true_product[$value['product_id']];
			if(!$this_proudct || !is_array($this_proudct))
			{
				continue;
			}
			if(!array_key_exists('discount', $this_proudct))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			if(!isset($check_true_product[$value['product_id']]))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}


			$factor_detail_record = [];

			$price      = floatval($this_proudct['price']);
			$discount   = $value['discount'] === null ? floatval($this_proudct['discount']) : floatval($value['discount']);
			$vat        = 0;
			$finalprice = $price - $discount;
			$count      = floatval($value['count']);
			if(!$count)
			{
				$count = 1;
			}


			if(array_key_exists('vat', $this_proudct) && $this_proudct['vat'])
			{
				$vat_percent = 9; // 9% in iran. need to get from setting
				if($vat_percent)
				{
					$new_finalprice = ($price - $discount) + ((($price - $discount) * $vat_percent) / 100);
					$vat            = $new_finalprice - ($price - $discount);
					$finalprice     = $new_finalprice;
				}
			}

			$factor_detail_record['product_id']        = $value['product_id'];

			$factor_detail_record['price']             = $price;
			$factor_detail_record['discount']          = $discount;
			$factor_detail_record['vat']               = $vat;
			$factor_detail_record['finalprice']        = $finalprice;
			$factor_detail_record['count']             = $count;
			$factor_detail_record['sum']               = $finalprice * $count;

			$factor_detail_record['sub_vat_temp']      = $vat * $count;
			$factor_detail_record['sub_price_temp']    = $price * $count;
			$factor_detail_record['sub_discount_temp'] = $discount * $count;

			$factor_detail[] = $factor_detail_record;
		}

		return $factor_detail;
	}
}
?>