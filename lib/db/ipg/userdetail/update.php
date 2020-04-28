<?php
namespace lib\db\ipg\userdetail;

class update
{
	public static function update_user_id($_args, $_user_id)
	{
		$set = \dash\db\config::make_set($_args);
		if(!$set)
		{
			return false;
		}

		$query  = "UPDATE userdetail SET $set WHERE userdetail.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query, 'shaparak');
		return $result;
	}

}
?>