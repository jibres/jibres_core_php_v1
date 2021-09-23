<?php
namespace lib\db\factors;

class get
{

	public static function user_discount_usage_count($_discount_id, $_user_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM factors WHERE factors.customer = $_user_id AND factors.discount_id = $_discount_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function discount_usage_total_count($_discount_id)
	{
		$query = "SELECT COUNT(*) AS `count` FROM factors WHERE factors.discount_id = $_discount_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_group_by_month_fuel($_fuel, $_dbname)
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				SUM(factors.total) AS `sum`,
				SUM(IF(factors.total > 50000000, 0, 1)) AS `count_filtered`,
				SUM(IF(factors.total > 50000000, 0, factors.total)) AS `sum_filtered`,
				CONCAT(YEAR(factors.datecreated), '-', MONTH(factors.datecreated)) AS `year_month`
			FROM
				factors
			GROUP by
				`year_month`
		";

		$result = \dash\db::get($query, null, false, $_fuel, ['database' => $_dbname]);

		return $result;
	}


	public static function count_factor_record_per_user($_user_id, $_start_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM factors WHERE factors.customer = $_user_id AND factors.status = 'registered' AND factors.date > '$_start_date' ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_factor_record_per_ip($_ip_id, $_start_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM factors WHERE factors.status = 'registered' AND factors.date > '$_start_date' AND factors.ip_id = $_ip_id ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function count_factor_record_per_ip_agent($_ip_id, $_agent_id, $_start_date)
	{
		$query = "SELECT COUNT(*) AS `count` FROM factors WHERE factors.status = 'registered' AND factors.date > '$_start_date' AND factors.ip_id = $_ip_id AND factors.agent_id = $_agent_id  ";
		$result = \dash\db::get($query, 'count', true);
		return floatval($result);
	}


	public static function sum_all()
	{
		$query   = "SELECT SUM(factors.total) AS `sum` FROM factors where factors.status != 'deleted' ";
		$result = \dash\db::get($query, 'sum', true);
		return $result;
	}


	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM factors where factors.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_all_buy()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM factors where factors.status != 'deleted' AND factors.type = 'buy' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function count_all_sale()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM factors where factors.status != 'deleted' AND factors.type = 'sale' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}


	public static function last_order($_user_id)
	{
		$query = "SELECT factors.*  FROM factors WHERE factors.type = 'sale' AND factors.customer = $_user_id ORDER BY factors.id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result ? $result : null;
	}




	public static function total_order_user_count($_user_id)
	{
		$query = "SELECT COUNT(*) as `count`  FROM factors WHERE factors.type = 'sale' AND factors.customer = $_user_id AND factors.status != 'deleted' ";
		$result = \dash\db::get($query, 'count', true);
		return $result ? $result : null;
	}


	public static function average_order_pay_user($_user_id)
	{
		$query = "SELECT AVG(factors.total) as `avg`  FROM factors WHERE factors.type = 'sale' AND factors.customer = $_user_id AND factors.status != 'deleted' ";
		$result = \dash\db::get($query, 'avg', true);
		return $result ? $result : null;
	}


	public static function total_order_pay_user($_user_id)
	{
		$query = "SELECT SUM(factors.total) as `sum`  FROM factors WHERE factors.type = 'sale' AND factors.customer = $_user_id AND factors.status != 'deleted' ";
		$result = \dash\db::get($query, 'sum', true);
		return $result ? $result : null;
	}


	private static function unprocessed_order_query()
	{
		$query = "SELECT COUNT(*) as `count` FROM factors WHERE factors.paystatus != 'awaiting_payment' AND factors.status IN ('registered', 'awaiting', 'confirmed', 'preparing', 'sending') AND  factors.type IN ('sale', 'saleorder') ";
		return $query;
	}


	public static function count_new_order_fuel($_fuel, $_db_name)
	{
		// type: 'sale','buy','presell','lending','backbuy','backsell','waste','saleorder'
		// status: 'draft','registered','awaiting','confirmed','cancel','expire','preparing','sending','delivered','revert','success','complete','archive','deleted','spam'
		$result = \dash\db::get(self::unprocessed_order_query(), 'count', true, $_fuel, ['database' => $_db_name]);
		return $result;
	}

	public static function count_new_order()
	{
		// type: 'sale','buy','presell','lending','backbuy','backsell','waste','saleorder'
		// status: 'draft','registered','awaiting','confirmed','cancel','expire','preparing','sending','delivered','revert','success','complete','archive','deleted','spam'
		$result = \dash\db::get(self::unprocessed_order_query(), 'count', true);
		return $result;
	}




	public static function last_sale_date()
	{
		$query = "SELECT factors.datecreated AS `datecreated` FROM factors WHERE factors.type = 'sale' ORDER BY factors.id LIMIT 1";
		$result = \dash\db::get($query, 'datecreated', true);
		return $result ? $result : null;
	}

	public static function last_buy_date()
	{
		$query = "SELECT factors.datecreated AS `datecreated` FROM factors WHERE factors.type = 'buy' ORDER BY factors.id LIMIT 1";
		$result = \dash\db::get($query, 'datecreated', true);
		return $result ? $result : null;
	}


	public static function by_id($_id)
	{
		$query = "SELECT * FROM factors WHERE factors.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}

	public static function by_id_user_id($_id, $_user_id)
	{
		$query = "SELECT * FROM factors WHERE factors.id = $_id AND factors.customer = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function first_factor_id()
	{
		$query  = "SELECT factors.id AS `id` FROM factors WHERE factors.status != 'deleted' ORDER BY factors.id ASC LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	public static function end_factor_id()
	{
		$query  = "SELECT factors.id AS `id` FROM factors WHERE factors.status != 'deleted' ORDER BY factors.id DESC LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}



	public static function prev($_id)
	{
		$query  = "SELECT factors.id AS `id` FROM factors WHERE factors.id = (SELECT MAX(factors.id) FROM factors WHERE factors.status != 'deleted' AND factors.id < $_id) LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}

	public static function next($_id)
	{
		$query  = "SELECT factors.id AS `id` FROM factors WHERE factors.id = (SELECT MIN(factors.id) FROM factors WHERE factors.status != 'deleted' AND factors.id > $_id) LIMIT 1 ";
		$result = \dash\db::get($query, 'id', true);
		return $result;
	}


	private static function load_my_order_detail($_id, $_user_id, $_guestid)
	{
		$user_id = null;
		if($_user_id)
		{
			$user_id = " AND factors.customer = $_user_id ";
		}

		$guestid = null;
		if($_guestid)
		{
			$guestid = " AND factors.guestid = '$_guestid' ";
		}
		$query =
		"
			SELECT
				factors.*

			FROM
				factors
			WHERE
				factors.id = $_id
				$user_id
				$guestid
			LIMIT 1
		";
		$result = \dash\db::get($query, null, true);

		return $result;

	}

	public static function load_my_order_user_id($_id, $_user_id)
	{
		return self::load_my_order_detail($_id, $_user_id, null);
	}


	public static function load_my_order_guestid($_id, $_guestid)
	{
		return self::load_my_order_detail($_id, null, $_guestid);
	}



}
?>
