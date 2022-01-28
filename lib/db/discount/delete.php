<?php
namespace lib\db\discount;


class delete
{

	public static function by_id($_id)
	{
		$query  = "DELETE FROM discount WHERE discount.id = :id LIMIT 1";
		$param = [':id' => $_id];
		$result = \dash\pdo::query($query, $param);
		return $result;

	}

}
?>
