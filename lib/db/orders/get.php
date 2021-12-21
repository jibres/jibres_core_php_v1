<?php
namespace lib\db\orders;

class get
{

	public static function load_with_special_type(float $_factor_id, string $_type) : array | bool
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