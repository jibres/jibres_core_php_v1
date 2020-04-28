<?php
namespace lib\db\shaparak\contract;


class get
{
	public static function my_first_contract($_user_id)
	{
		$query  = "SELECT *  FROM contract WHERE contract.user_id = $_user_id ORDER BY contract.id ASC LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


	public static function by_id($_id)
	{
		$query  = "SELECT *  FROM contract WHERE contract.id = $_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'shaparak');
		return $result;
	}


}
?>