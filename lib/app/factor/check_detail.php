<?php
namespace lib\app\factor;


class check_detail
{



	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor_detail($_args, $_option = [])
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


		$condition =
		[
			'list' => ['product' => 'id', 'count' => 'smallint', 'discount' => 'price', 'price' => 'price'],
		];

		$require = [];

		$meta    =	[];

		$data = \dash\cleanse::input(['list' => $_args], $condition, $require, $meta);


		$list             = $data['list'];


		$decode_list      = [];
		$allproduct_id    = [];
		$trust_order_list = [];

		foreach ($list as $key => $value)
		{

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
				case 'saleorder':
					// nothing to save
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
			$trust_order_list[$key]['discount']   = (isset($value['discount'])) ? floatval($value['discount']) : null;
			$trust_order_list[$key]['product_id'] = $value['product'];

			$allproduct_id[]              = $value['product'];
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

			if(isset($this_proudct['variant_child']) && $this_proudct['variant_child'])
			{
				\dash\notif::error(T_("This product has different types. Please specify one of these types"));
				return false;
			}

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

			// check need track stock or no
			if(isset($this_proudct['trackquantity']) && $this_proudct['trackquantity'] === 'yes')
			{
				$factor_detail_record['track_stock_temp'] = true;
			}
			else
			{
				$factor_detail_record['track_stock_temp'] = false;
			}


			if(array_key_exists('vat', $this_proudct) && $this_proudct['vat'] === 'yes')
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

			$factor_detail_record['status']            = 'enable';
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