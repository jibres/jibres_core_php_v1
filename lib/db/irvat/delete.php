<?php
namespace lib\db\irvat;


class delete
{
	public static function record($_id)
	{
		$query = "DELETE FROM ir_vat WHERE ir_vat.id = $_id LIMIT 1";
		$result = \dash\db::query($query);
		return $result;
	}
}
?>