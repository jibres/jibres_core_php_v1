<?php
namespace lib\db\factordetails;


class delete
{

	public static function by_factor_id($_factor_id)
	{
		$query = "UPDATE factordetails SET factordetails.status = 'deleted' WHERE factordetails.factor_id = $_factor_id ";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function by_id($_id)
	{
		$query = "UPDATE factordetails SET factordetails.status = 'deleted' WHERE factordetails.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}

	public static function record($_id)
	{
		$query = "DELETE FROM factordetails WHERE factordetails.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>