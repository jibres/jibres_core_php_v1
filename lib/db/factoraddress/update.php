<?php
namespace lib\db\factoraddress;


class update
{
	public static function record($_args, $_factor_id)
	{
		$set    = \dash\db\config::make_set($_args);
		$query  = "UPDATE factoraddress SET $set WHERE factoraddress.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>