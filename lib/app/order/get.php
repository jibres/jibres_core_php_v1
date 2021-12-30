<?php
namespace lib\app\order;


class get
{
	/**
	 * Load id by check type
	 *
	 * @param      <type>  $_id    The identifier
	 * @param      string  $_type  The type
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function load_with_special_type($_id, $_type)
	{

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_with_special_type = \lib\db\orders\get::load_with_special_type($id, $_type);

		if(!$load_with_special_type)
		{
			\dash\notif::error(T_("Order by this special type not found"));
			return false;
		}

		$order = ready::row($load_with_special_type);

		return $order;
	}



	/**
	 * Get order detail by order id
	 *
	 * @param      <type>  $_factor_id  The factor identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function detail_by_order_id($_factor_id)
	{

		$factor_id = \dash\validate::id($_factor_id);

		if(!$factor_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}


		$list = \lib\db\orderdetails\get::by_order_id($factor_id);

		$list = array_map(['\\lib\\app\\order\\ready', 'detail'], $list);

		return $list;
	}


	public static function buy_opr_merger_duplicate(array $_factor_detail) : array
	{
		$new_list = [];

		foreach ($_factor_detail as $key => $value)
		{
			$product_price  = floatval($value['product_price']);
			$count          = floatval($value['count']);
			$discount       = floatval($value['discount']);
			$price          = floatval($value['price']);
			$profit         = $discount * $count;
			$price_per_item = ($price - $discount) * $count;

			$eshantion = false;
			if($price === $discount && $price && $price_per_item == 0)
			{
				$eshantion = true;
			}


			if(!isset($new_list[$value['product_id']]))
			{
				$new_list[$value['product_id']]              = $value;
				$new_list[$value['product_id']]['oprmerger'] =
				[
					'price'          => [$product_price],
					'count'          => [$count],
					'buyprice'       => [$price],
					'profit'         => [$profit],
					'discount'       => [$discount],
					'price_per_item' => [$price_per_item],
					'multiple'       => false,
					'eshantion'      => [$eshantion],
					'multiple_count' => 1,
				];
			}
			else
			{
				$new_list[$value['product_id']]['oprmerger']['price'][]          = $product_price;
				$new_list[$value['product_id']]['oprmerger']['count'][]          = $count;
				$new_list[$value['product_id']]['oprmerger']['buyprice'][]       = $price; // in buy order the price is buy price
				$new_list[$value['product_id']]['oprmerger']['discount'][]       = floatval($value['discount']);
				$new_list[$value['product_id']]['oprmerger']['profit'][]         = floatval($value['discount']) * floatval($value['count']);

				$new_list[$value['product_id']]['oprmerger']['price_per_item'][] = (floatval($value['price']) - floatval($value['discount'])) * floatval($value['count']);
				$new_list[$value['product_id']]['oprmerger']['multiple']         = true;
				$new_list[$value['product_id']]['oprmerger']['eshantion'][]      = $eshantion;
				$new_list[$value['product_id']]['oprmerger']['multiple_count']++;
			}
		}

		$total_profit = 0;

		foreach ($new_list as $key => $value)
		{
			$suggestion             = [];
			$suggestion['multiple'] = $value['oprmerger']['multiple'];
			$suggestion['price']    = max($value['oprmerger']['price']);
			$suggestion['discount'] = min($value['oprmerger']['discount']);
			$suggestion['profit']   = array_sum($value['oprmerger']['profit']);

			$total_profit += $suggestion['profit'];

			$count                  = array_sum($value['oprmerger']['count']);
			$suggestion['count']    = $count;

			if(!$count)
			{
				$count = 1;
			}

			$price_per_item = array_sum($value['oprmerger']['price_per_item']);

			$suggestion['buyprice'] = round(($price_per_item) / $count);

			$new_list[$key]['suggestion'] = $suggestion;

			// unset($new_list[$key]['oprmerger']);
		}


		// var_dump($new_list);exit;
		return $new_list;
	}






	public static function customer_debt($_factor_id, $_customer_id, $_current_factor_total)
	{
		$customer_id = \dash\coding::decode($_customer_id);

		if(!$customer_id || !is_numeric($customer_id))
		{
			return false;
		}

		$current_debt = \dash\app\transaction\budget::user($customer_id);

		$debt_until_order = \lib\db\orders\get::debt_until_order($_factor_id, $customer_id);

		$debt_with_order = 0;

		$result                     = [];
		$result['debt_until_order'] = $debt_until_order;
		$result['debt_with_order']  = $debt_until_order - floatval($_current_factor_total);
		$result['current_debt']     = $current_debt;
		$result['display_detail']   = true;

		if(intval($debt_until_order) === 0 && intval($current_debt) === 0)
		{
			$result['display_detail']   = false;
		}


		return $result;

	}
}
?>