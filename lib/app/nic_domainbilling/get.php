<?php
namespace lib\app\nic_domainbilling;


class get
{
	public static function group_by_action()
	{
		$list = \lib\db\nic_domainbilling\get::group_by_action();
		return $list;
	}
}
?>