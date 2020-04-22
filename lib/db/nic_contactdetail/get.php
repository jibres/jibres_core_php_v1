<?php
namespace lib\db\nic_contactdetail;


class get
{
	public static function by_nic_id($_nic_id)
	{
		$query  = "SELECT * FROM contactdetail WHERE contactdetail.nic_id = '$_nic_id' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}
}
?>
