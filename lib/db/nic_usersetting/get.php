<?php
namespace lib\db\nic_usersetting;


class get
{
	public static function my_setting($_user_id)
	{
		$query  = "SELECT *  FROM usersetting WHERE usersetting.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');
		return $result;
	}


}
?>