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


		// ProductEdit
		// changePriceInSalePage
		// changeDiscountInSalePage
		// updatepriceonsalepage


		$allproduct_id    = array_column($list, 'product');
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

			if(is_numeric($value['price']))
			{
				$price      = floatval($value['price']);
			}
			else
			{
				$price      = floatval($this_proudct['price']);
			}


			if(is_numeric($value['discount']))
			{
				$discount      = floatval($value['discount']);
			}
			else
			{
				$discount      = floatval($this_proudct['discount']);
			}

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
}
?>