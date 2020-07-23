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
}
?>