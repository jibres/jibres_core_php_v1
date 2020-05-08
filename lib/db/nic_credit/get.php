<?php
namespace lib\db\nic_credit;


class get
{

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