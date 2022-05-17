<?php
namespace lib\db\orders;

class get
{

	public static function load_with_special_type(float $_factor_id, string $_type)
	{
		$query  = "SELECT * FROM factors WHERE factors.id = :factorid AND factors.type = :type LIMIT 1 ";

		$param  =
		[
			':factorid' => $_factor_id,
			':type'     => $_type,
		];

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}


	/**
	 * Ping record is exists
	 *
	 * @param      float   $_factor_id  The factor identifier
	 * @param      string  $_type       The type
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function ping_row(float $_factor_id, string $_type = null)
	{
		$param = [];
		$type = null;

		if($_type)
		{
			$type = ' AND factors.type = :type ';
			$param[':type'] = $_type;
		}

		$query  = "SELECT factors.id AS `id`, factors.type FROM factors WHERE factors.id = :factorid $type LIMIT 1 ";

		$param[':factorid'] = $_factor_id;

		$result = \dash\pdo::get($query, $param, null, true);

		return $result;
	}


	public static function first_factor($_type = null)
	{
		$param = [];

		$type = null;

		if($_type)
		{
			$type = ' AND factors.type = :type ';
			$param[':type'] = $_type;
		}

		$query  = "SELECT * FROM factors WHERE factors.status != 'deleted' $type ORDER BY factors.id ASC LIMIT 1";

		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}



	public static function first_factor_id($_type = null)
	{
		$param = [];

		$type = null;

		if($_type)
		{
			$type = ' AND factors.type = :type ';
			$param[':type'] = $_type;
		}

		$query  = "SELECT factors.id AS `id` FROM factors WHERE factors.status != 'deleted' $type ORDER BY factors.id ASC LIMIT 1";

		$result = \dash\pdo::get($query, $param, 'id', true);
		return $result;
	}


	public static function next($_id, $_type)
	{
		$param = [];

		$type = null;

		if($_type)
		{
			$type = ' AND factors.type = :type ';
			$param[':type'] = $_type;
		}

		$query  = "SELECT MIN(factors.id) AS `id` FROM factors WHERE factors.status != 'deleted' AND factors.id > :id $type LIMIT 1 ";

		$param[':id'] = $_id;

		$result = \dash\pdo::get($query, $param, 'id', true);
		return $result;
	}



	public static function end_factor_id($_type = null)
	{
		$param = [];

		$type = null;

		if($_type)
		{
			$type = ' AND factors.type = :type ';
			$param[':type'] = $_type;
		}

		$query  = "SELECT factors.id AS `id` FROM factors WHERE factors.status != 'deleted' $type ORDER BY factors.id DESC LIMIT 1 ";

		$result = \dash\pdo::get($query, $param, 'id', true);
		return $result;
	}



	public static function prev($_id, $_type = null)
	{
		$param = [];

		$type = null;

		if($_type)
		{
			$type = ' AND factors.type = :type ';
			$param[':type'] = $_type;
		}

		$query  = "SELECT MAX(factors.id) AS `id` FROM factors WHERE factors.status != 'deleted' AND factors.id < :id $type LIMIT 1 ";

		$param[':id'] = $_id;

		$result = \dash\pdo::get($query, $param, 'id', true);

		return $result;
	}






	public static function debt_until_order($_factor_id, $_customer_id)
	{
		$query  = "SELECT MIN(transactions.id) AS `id` FROM transactions WHERE transactions.factor_id = :factorid ";
		$param  = [':factorid' => $_factor_id];
		$result = \dash\pdo::get($query, $param, 'id', true);

		if(!$result || !is_numeric($result))
		{
			return false;
		}

		$debt_until_order = \dash\db\transactions::budget_before_special_id($_customer_id, $result);

		return $debt_until_order;
	}
}
?>