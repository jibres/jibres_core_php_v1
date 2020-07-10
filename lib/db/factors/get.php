<?php
namespace lib\db\factors;

class get
{
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


	public static function last_sale_date()
	{
		$query = "SELECT factors.datecreated AS `datecreated` FROM factors WHERE factors.type = 'sale' ORDER BY factors.id LIMIT 1";
		$result = \dash\db::Get($query, 'datecreated', true);
		return $result ? $result : null;
	}

	public static function last_buy_date()
	{
		$query = "SELECT factors.datecreated AS `datecreated` FROM factors WHERE factors.type = 'buy' ORDER BY factors.id LIMIT 1";
		$result = \dash\db::Get($query, 'datecreated', true);
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

}
?>
