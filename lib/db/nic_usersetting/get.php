<?php
namespace lib\db\nic_usersetting;


class get
{
	private static $usersetting = [];

	public static function my_setting($_user_id)
	{
		if(isset(self::$usersetting[$_user_id]))
		{
			return self::$usersetting[$_user_id];
		}

		$query  = "SELECT *  FROM usersetting WHERE usersetting.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic');

		self::$usersetting[$_user_id] = $result;

		return $result;
	}


}
?>