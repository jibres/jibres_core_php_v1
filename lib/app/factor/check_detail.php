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
		$new_list      = [];

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
					\dash\notif::error(T_("Invalid factor type"), 'type');
					return false;

					break;

					// -------------------- prefactor
					case 'prefactor':
						// no thing
						break;

					// -------------------- backbuy
					case 'lending':

						break;

					// -------------------- backbuy
					case 'backbuy':
						break;

					// -------------------- backfactor
					case 'backfactor':

						break;

					// -------------------- wast
					case 'waste':

						break;

					// invalid type
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

			$new_list[$key]['count']      = floatval($value['count']);
			$new_list[$key]['discount']   = (isset($value['discount'])) ? intval($value['discount']) : null;
			$new_list[$key]['product_id'] = $product_id;

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

		foreach ($new_list as $key => $value)
		{
			$temp = [];

			if(!isset($check_true_product[$value['product_id']]))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			$this_proudct = $check_true_product[$value['product_id']];

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

					if(array_key_exists('price', $this_proudct))
					{
						$price = floatval($this_proudct['price']);
					}

					if(array_key_exists('finalprice', $this_proudct))
					{
						$finalprice = floatval($this_proudct['finalprice']);
					}

					if(array_key_exists('vatprice', $this_proudct))
					{
						$vatprice = floatval($this_proudct['vatprice']);
					}

					$temp['discount']   = $value['discount'] === null ? $this_proudct['discount'] : $value['discount'];
					$temp['sum']        = floatval($finalprice) * floatval($value['count']);
					break;

				case 'buy':
					// if(array_key_exists('buyprice', $this_proudct))
					// {
					// 	$price = floatval($this_proudct['buyprice']);
					// }

					// $temp['sum'] = floatval($price) * floatval($value['count']);
					break;

				case 'prefactor':
				case 'lending':
				case 'backbuy':
				case 'backfactor':
				case 'waste':

					break;
			}

			$temp['product_id'] = $value['product_id'];
			$temp['price']      = $finalprice;
			$temp['count']      = $value['count'] === null ? 1 : $value['count'];

			$factor_detail[] = $temp;
		}

		return $factor_detail;
	}
}
?>