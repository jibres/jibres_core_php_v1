<?php
namespace lib\app\order;


class check_detail
{



	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor_detail($_args, $_option = [])
	{

		$condition =
		[
			'list' =>
			[
				'product'  => 'id',
				'count'    => 'count',
				'discount' => 'price',
				'price'    => 'price',
			],
		];

		$require = [];
		$meta    =	[];
		$data    = \dash\cleanse::input(['list' => $_args], $condition, $require, $meta);
		$list    = $data['list'];

		// merge duplicate product
		$list = self::merger($list);

		$allproduct_id = array_column($list, 'product');
		$allproduct_id = array_unique($allproduct_id);
		if(empty($allproduct_id))
		{
			\dash\notif::error(T_("No valid products found in your list"));
			return false;
		}


		$check_true_product = \lib\db\products\get::by_multi_id_array($allproduct_id);
		$true_product_ids   = array_column($check_true_product, 'id');
		$check_true_product = array_combine($true_product_ids, $check_true_product);

		$factor_detail = [];

		foreach ($list as $key => $value)
		{
			// product not found in database!
			if(!isset($check_true_product[$value['product']]))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			// load product and check successfully loaded
			$this_proudct = $check_true_product[$value['product']];
			if(!is_array($this_proudct))
			{
				continue;
			}


			// check not sale parent of variant child
			if(isset($this_proudct['variant_child']) && $this_proudct['variant_child'])
			{
				\dash\notif::error(T_("Can not add parent of variant  proudct in order"));
				return false;
			}

			// check status of product
			// need check is customer mode and check not alowed product in order
			if(isset($this_proudct['status']) && $this_proudct['status'] === 'deleted')
			{
				\dash\notif::error(T_("Can not add deleted proudct in order"));
				return false;
			}


			if(!array_key_exists('discount', $this_proudct))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}


			$factor_detail_record = [];

			if(is_numeric($value['price']) && \dash\permission::check('changePriceInSalePage'))
			{
				$price      = floatval($value['price']);
			}
			else
			{
				$price      = floatval($this_proudct['price']);
			}


			if(is_numeric($value['discount']) && \dash\permission::check('changeDiscountInSalePage'))
			{
				$discount      = floatval($value['discount']);
			}
			else
			{
				$discount      = floatval($this_proudct['discount']);
			}


			/*===============================================================================
			=            Update product if feature is active and have permission            =
			===============================================================================*/
			$update_product = [];

			if($_option['type'] === 'sale' && $_option['updatepriceonsalepage'] && \dash\permission::check('ProductEdit'))
			{

				if(floatval($this_proudct['price']) !== floatval($price))
				{
					$update_product['price'] = $price;
				}

				if(floatval($this_proudct['discount']) !== floatval($discount))
				{
					$update_product['discount'] = $discount;
				}

			}

			if($_option['type'] === 'buy')
			{
				if(floatval($this_proudct['buyprice']) !== floatval($price))
				{
					$update_product['buyprice'] = $price;
				}
			}

			if(!empty($update_product))
			{
				\lib\app\product\edit::edit($update_product, $value['product'], ['debug' => false]);
			}
			/*=====  End of Update product if feature is active and have permission  ======*/



			$vat        = 0;

			$finalprice = $price - $discount;

			$count      = floatval($value['count']);

			if(!$count)
			{
				$count = 1;
			}

			// check need track stock or no
			$factor_detail_record['track_stock_temp'] = false;
			if(isset($this_proudct['trackquantity']) && $this_proudct['trackquantity'] === 'yes')
			{
				$factor_detail_record['track_stock_temp'] = true;
			}



			if(array_key_exists('vat', $this_proudct) && $this_proudct['vat'] === 'yes')
			{
				$vat_percent = \lib\vat::percent();
				if($vat_percent)
				{
					$vat        = (($finalprice * $vat_percent) / 100);
					$finalprice = $finalprice + $vat;
				}
			}

			$sum = $finalprice * $count;

			if($sum < 0)
			{
				\dash\notif::error(T_("Can not add factor item price less than 0"));
				return false;
			}


			$factor_detail_record['product_id']        = $value['product'];
			$factor_detail_record['status']            = 'enable';
			$factor_detail_record['price']             = $price;
			$factor_detail_record['discount']          = $discount;
			$factor_detail_record['vat']               = $vat;
			$factor_detail_record['finalprice']        = $finalprice;
			$factor_detail_record['count']             = $count;
			$factor_detail_record['sum']               = $sum;
			$factor_detail_record['sub_vat_temp']      = $vat * $count;
			$factor_detail_record['sub_price_temp']    = $price * $count;
			$factor_detail_record['sub_discount_temp'] = $discount * $count;
			$factor_detail_record['type']              = $this_proudct['type'];

			$factor_detail[] = $factor_detail_record;
		}

		return $factor_detail;
	}


	public static function merger(array $_list) : array
	{
		$new_list = [];

		foreach ($_list as $key => $value)
		{
			$dbl_key = '';
			$dbl_key .= strval($value['product']);
			$dbl_key .= '-';
			$dbl_key .= strval($value['price']);
			$dbl_key .= '-';
			$dbl_key .= strval($value['discount']);

			if(isset($new_list[$dbl_key]))
			{
				$new_list[$dbl_key]['count'] += $value['count'];
			}
			else
			{
				$new_list[$dbl_key] = $value;
			}
		}

		return array_values($new_list);
	}
}
?>