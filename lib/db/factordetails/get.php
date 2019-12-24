<?php
namespace lib\db\factordetails;

class get
{


	public static function by_factor_id($_id)
	{
		$query = "SELECT * FROM factordetails WHERE factordetails.factor_id = $_id";
		$result = \dash\db::get($query);
		return $result;
	}
}
?>
