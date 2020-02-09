<?php
namespace lib\db\nic_domain;


class get
{
	public static function user_list($_user_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.user_id = $_user_id ORDER BY domain.id DESC";
		$result = \dash\db::get($query, null, false, 'nic');
		return $result;
	}


	public static function by_id_user_id($_id, $_user_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.id = $_id AND domain.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


	public static function domain_user($_domina, $_user_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.name = '$_domina' AND domain.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;

	}



	public static function check_duplicate($_user_id, $_nic_id)
	{
		$query  = "SELECT * FROM domain WHERE domain.user_id = $_user_id AND domain.nic_id = '$_nic_id' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}
}
?>