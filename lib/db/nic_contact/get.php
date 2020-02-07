<?php
namespace lib\db\nic_contact;


class get
{
	public static function user_list($_user_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.user_id = $_user_id";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function check_duplicate($_user_id, $_nic_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.user_id = $_user_id AND contact.nic_id = '$_nic_id' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}
}
?>