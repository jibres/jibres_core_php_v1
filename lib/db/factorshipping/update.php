<?php
namespace lib\db\factorshipping;


class update
{
	public static function record($_args, $_factor_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE factorshipping SET $set WHERE factorshipping.factor_id = $_factor_id LIMIT 1";
		$result = \dash\pdo::query($query, []);
		return $result;
	}
}
?>