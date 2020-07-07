<?php
namespace dash\db\userlegal;


class update
{

	public static function by_user_id($_args, $_user_id)
	{
		$set = \dash\db\config::make_set($_args);
		$query  = "UPDATE userlegal SET $set WHERE userlegal.user_id = $_user_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>