<?php
namespace dash\db\userlegal;


class get
{

	public static function by_user_id($_user_id)
	{
		$query  = "SELECT * FROM userlegal WHERE userlegal.user_id = $_user_id LIMIT 1";
		$result = \dash\db::get($query, null, true);
		return $result;
	}


	public static function by_multi_id($_ids)
	{
		$query  = "SELECT *  FROM userlegal WHERE userlegal.user_id IN ($_ids) ";
		$result = \dash\db::get($query);

		return $result;
	}

}
?>