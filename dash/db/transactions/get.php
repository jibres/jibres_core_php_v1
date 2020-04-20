<?php
namespace dash\db\transactions;


class get
{

	public static function first_pay_user($_user_id)
	{
		$query = "SELECT * FROM transactions WHERE transactions.user_id = $_user_id AND transactions.verify = 1 LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}
}
?>