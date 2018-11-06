<?php
namespace lib\app\productprice;


class dashboard
{
	public static function glance($_product_id)
	{

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

}
?>