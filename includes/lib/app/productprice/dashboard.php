<?php
namespace lib\app\productprice;


class dashboard
{
	public static function glance($_product_id)
	{
		// if(\dash\permission::supervisor() && \dash\request::get('fix'))
		// {
		// 	self::fix_price();
		// }

		$product_id = \dash\coding::decode($_product_id);
		if(!$product_id)
		{
			return false;
		}

		$result         = [];
		$last_buy_date  = null;
		$last_sale_date = null;

		$last_buy = \lib\db\factors::product_last_factor_date($product_id, 'buy');
		if(isset($last_buy['datecreated']))
		{
			$last_buy_date = \dash\datetime::fit($last_buy['datecreated'], true);
		}

		$last_sale = \lib\db\factors::product_last_factor_date($product_id, 'sale');
		if(isset($last_sale['datecreated']))
		{
			$last_sale_date = \dash\datetime::fit($last_sale['datecreated'], true);
		}

		$low_sale_price = \lib\db\productprices::price_history_date($product_id, 'asc');
		if($low_sale_price)
		{
			$low_sale_price = \dash\datetime::fit($low_sale_price, true);
		}

		$top_sale_price = \lib\db\productprices::price_history_date($product_id, 'desc');
		if($top_sale_price)
		{
			$top_sale_price = \dash\datetime::fit($top_sale_price, true);
		}

		$result['last_buy']       = $last_buy_date;
		$result['last_sale']      = $last_sale_date;
		$result['last_buy_id']    = isset($last_buy['id']) ? \dash\coding::encode($last_buy['id']) : null;
		$result['last_sale_id']   = isset($last_sale['id']) ? \dash\coding::encode($last_sale['id']) : null;

		$result['top_sale_price'] = $top_sale_price;
		$result['low_sale_price'] = $low_sale_price;



		return $result;
	}





	// private static function fix_price()
	// {
	// 	\dash\db::query("DELETE FROM productprices WHERE productprices.buyprice IS NULL AND productprices.price IS NULL AND productprices.discount IS NULL");

	// 	$query = "SELECT GROUP_CONCAT(productprices.id) AS `ids` FROM productprices GROUP BY productprices.product_id HAVING COUNT(*) > 1";
	// 	$result = \dash\db::get($query, 'ids');
	// 	if(!is_array($result))
	// 	{
	// 		return;
	// 	}

	// 	$count = 0;

	// 	foreach ($result as $ids)
	// 	{
	// 		$query_get = "SELECT * FROM productprices WHERE productprices.id IN ($ids) ORDER BY productprices.id ASC";
	// 		$data = \dash\db::get($query_get);
	// 		if(!is_array($data))
	// 		{
	// 			continue;
	// 		}

	// 		$last_price    = null;
	// 		$last_buyprice = null;
	// 		$last_discount = null;

	// 		$mulitQuery = [];
	// 		foreach ($data as $key => $record)
	// 		{
	// 			if($key === 0)
	// 			{
	// 				$last_buyprice = $record['buyprice'];
	// 				$last_price    = $record['price'];
	// 				$last_discount = $record['discount'];
	// 				continue;
	// 			}

	// 			$update = [];

	// 			if(!$record['buyprice'] && $last_buyprice)
	// 			{
	// 				$update['buyprice'] = $last_buyprice;
	// 				$record['buyprice'] = $last_buyprice;
	// 			}

	// 			if(!$record['price'] && $last_price)
	// 			{
	// 				$update['price'] = $last_price;
	// 				$record['price'] = $last_price;
	// 			}

	// 			if(!$record['discount'] && $last_discount)
	// 			{
	// 				$update['discount'] = $last_discount;
	// 				$record['discount'] = $last_discount;
	// 			}

	// 			if(!empty($update))
	// 			{
	// 				$set = \dash\db\config::make_set($update);
	// 				$mulitQuery[] = " UPDATE productprices SET $set WHERE productprices.id = $record[id] LIMIT 1 ";
	// 			}

	// 			$last_buyprice = $record['buyprice'] ? $record['buyprice']: $last_buyprice;
	// 			$last_price    = $record['price'] ? $record['price']: $last_price;
	// 			$last_discount = $record['discount'] ? $record['discount']: $last_discount;
	// 		}

	// 		if(!empty($mulitQuery))
	// 		{
	// 			$count += count($mulitQuery);
	// 			$mulitQuery = implode(';', $mulitQuery);
	// 			\dash\db::query($mulitQuery, true, ['multi_query' => true]);
	// 		}
	// 	}
	// 	\dash\code::dump($count);
	// 	\dash\code::boom();
	// }
}
?>