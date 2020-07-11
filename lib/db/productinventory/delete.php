<?php
namespace lib\db\productinventory;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM productinventory WHERE productinventory.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>