<?php
namespace lib\db\factoraction;


class delete
{

	public static function by_id_factor_id($_id, $_factor_id)
	{
		$query = "DELETE FROM factoraction  WHERE factoraction.id = $_id AND factoraction.factor_id = $_factor_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>