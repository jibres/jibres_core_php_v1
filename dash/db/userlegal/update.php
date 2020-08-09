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


	public static function set_null_accounting($_accounting_id)
	{
		$query  = "UPDATE userlegal SET userlegal.accounting_details_id = NULL WHERE userlegal.accounting_details_id = $_accounting_id ";
		$result = \dash\db::query($query);
		return $result;
	}

}
?>