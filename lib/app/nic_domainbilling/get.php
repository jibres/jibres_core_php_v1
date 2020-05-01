<?php
namespace lib\app\nic_domainbilling;


class get
{
	public static function group_by_action()
	{
		$list = \lib\db\nic_domainbilling\get::group_by_action();

		$new_list            = [];
		$new_list["All"] = array_sum($list);
		$new_list            = array_merge($new_list, $list);
		return $new_list;
	}


	public static function price_group()
	{

		$list = \lib\db\nic_domainbilling\get::group_by_price();
		return $list;
	}
}
?>