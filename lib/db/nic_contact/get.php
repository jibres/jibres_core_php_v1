<?php
namespace lib\db\nic_contact;


class get
{
	public static function user_list($_user_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.user_id = $_user_id AND contact.status != 'deleted' ORDER BY contact.id DESC";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function by_id_user_id($_id, $_user_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.id = $_id AND contact.user_id = $_user_id AND contact.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function user_nic_id($_user_id, $_nic_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.nic_id = '$_nic_id' AND contact.user_id = $_user_id AND contact.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}



	public static function check_duplicate($_user_id, $_nic_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.user_id = $_user_id AND contact.nic_id = '$_nic_id' AND contact.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}



	public static function by_nic_id($_nic_id, $_user_id)
	{
		$query  = "SELECT * FROM contact WHERE contact.user_id = $_user_id AND contact.nic_id = '$_nic_id' AND contact.status != 'deleted' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}
}
?>