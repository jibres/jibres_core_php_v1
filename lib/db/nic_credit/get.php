<?php
namespace lib\db\nic_credit;


class get
{
	public static function check_refund()
	{
		$query  = "SELECT * FROM credit WHERE credit.domain IS NOT NULL AND credit.amount > 0 AND credit.refund_transaction_id IS NULL AND credit.meta IS NULL";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}

	public static function check_duplicate($_date, $_roid)
	{
		$query  = "SELECT * FROM credit WHERE credit.date = '$_date' AND credit.roid = '$_roid' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function last()
	{
		$query  = "SELECT * FROM credit ORDER BY id DESC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}
}
?>