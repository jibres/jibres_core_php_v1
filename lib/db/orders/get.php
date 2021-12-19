<?php
namespace lib\db\orders;

class get
{
	public static function debt_until_order($_factor_id, $_customer_id)
	{
		$query  = "SELECT MIN(transactions.id) AS `id` FROM transactions WHERE transactions.factor_id = :factorid ";
		$param  = [':factorid' => $_factor_id];
		$result = \dash\db::get_bind($query, $param, 'id', true);

		if(!$result || !is_numeric($result))
		{
			return false;
		}

		$debt_until_order = \dash\db\transactions::budget_before_special_id($_customer_id, $result);

		return $debt_until_order;
	}
}
?>