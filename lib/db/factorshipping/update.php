<?php
namespace lib\db\factorshipping;


class update
{
	public static function record($_args, $_factor_id)
	{
		$q      = \dash\pdo\prepare_query::generate_set('factorshipping', $_args);

		$query  = "UPDATE factorshipping SET $q[set] WHERE factorshipping.factor_id = :factor_id LIMIT 1";

		$param  = array_merge($q['param'], [':factor_id' => $_factor_id]);

		$result = \dash\pdo::query($query, $param);

		return $result;
	}
}
?>