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
			$product_price = floatval($value['product_price']);
			$count         = floatval($value['count']);
			$discount      = floatval($value['discount']);
			$price         = floatval($value['price']);
			$profit        = $discount * $count;
			$finalprice    = ($price - $discount) * $count;

			$eshantion = 0;
			if($price === $discount && $price && $finalprice == 0)
			{
				$eshantion = ($price * $count);
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
					'finalprice'     => [$finalprice],
					'multiple'       => false,
					'eshantion'      => [$eshantion],
					'multiple_count' => 1,
				];
			}
			else
			{
				$new_list[$value['product_id']]['oprmerger']['price'][]      = $product_price;
				$new_list[$value['product_id']]['oprmerger']['count'][]      = $count;
				$new_list[$value['product_id']]['oprmerger']['buyprice'][]   = $price; // in buy order the price is buy price
				$new_list[$value['product_id']]['oprmerger']['discount'][]   = floatval($value['discount']);
				$new_list[$value['product_id']]['oprmerger']['profit'][]     = floatval($value['discount']) * floatval($value['count']);

				$new_list[$value['product_id']]['oprmerger']['finalprice'][] = (floatval($value['price']) - floatval($value['discount'])) * floatval($value['count']);
				$new_list[$value['product_id']]['oprmerger']['multiple']     = true;
				$new_list[$value['product_id']]['oprmerger']['eshantion'][]  = $eshantion;
				$new_list[$value['product_id']]['oprmerger']['multiple_count']++;
			}
		}

		$total_profit     = 0;
		$total_eshantion  = 0;
		$total_finalprice = 0;
		$other_eshantion  = false;

		foreach ($new_list as $key => $value)
		{
			$suggestion              = [];
			$suggestion['multiple']  = $value['oprmerger']['multiple'];
			$suggestion['price']     = max($value['oprmerger']['price']);
			$suggestion['discount']  = min($value['oprmerger']['discount']);
			$suggestion['profit']    = array_sum($value['oprmerger']['profit']);
			$suggestion['eshantion'] = array_sum($value['oprmerger']['eshantion']);

			$total_profit += $suggestion['profit'];

			$suggestion['other_eshantion'] = false;

			if(!a($value, 'oprmerger', 'multiple') && $suggestion['eshantion'])
			{
				$total_eshantion += $suggestion['eshantion'];
				$suggestion['other_eshantion'] = $suggestion['eshantion'];
				$other_eshantion = true;
			}

			$count                  = array_sum($value['oprmerger']['count']);
			$suggestion['count']    = $count;

			if(!$count)
			{
				$count = 1;
			}

			$finalprice = array_sum($value['oprmerger']['finalprice']);

			$suggestion['finalprice'] = $finalprice;

			$total_finalprice += $finalprice;

			$suggestion['buyprice'] = round(($finalprice) / $count);

			$new_list[$key]['suggestion'] = $suggestion;
		}

		if($total_eshantion && $other_eshantion)
		{
			$percent = \dash\number::percent($total_eshantion, $total_finalprice);
			// if($percent > 100)
			// {
			// 	$percent = 100;
			// }

			foreach ($new_list as $key => $value)
			{
				if(a($value, 'suggestion', 'other_eshantion') === false)
				{
					$new_list[$key]['suggestion']['percent'] = $percent;
					$new_buy_price = a($value, 'suggestion', 'buyprice') - (($percent * a($value, 'suggestion', 'buyprice')) / 100);

					if($new_buy_price < 0)
					{
						$new_buy_price = 0;
					}

					$new_list[$key]['suggestion']['new_buyprice'] = $new_buy_price;
				}

			}
		}


		$result                = [];
		$result['detail'] =
		[
			'profit'          => $total_profit,
			'eshantion'       => $total_eshantion,
			'other_eshantion' => $other_eshantion,
		];

		$result['list']        = $new_list;

		// var_dump($result);exit();
		return $result;

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


	public static function year_list()
	{
		$year_list = [];

		$firs_order = \lib\db\orders\get::first_factor();

		$first_year = null;
		$this_year  = substr(\dash\fit::date_en(date("Y-m-d")), 0 , 4);

		if($firs_order && a($firs_order, 'date'))
		{
			$first_year = \dash\fit::date_en(date("Y-m-d", strtotime($firs_order['date'])));
			$first_year = substr($first_year, 0, 4);
			$first_year = intval($first_year);
		}

		if($first_year)
		{
			for ($i=$first_year; $i < $this_year ; $i++)
			{
				$year_list[] = ['year' => $i, 'title' => T_("Year"). ' '. \dash\fit::text($i)];
			}
		}

		$year_list[] = ['year' => intval($this_year), 'title' => T_("Year"). ' '. \dash\fit::text($this_year)];

		return $year_list;
	}
}
?>